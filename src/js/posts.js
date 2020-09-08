import trace from '@tvg/trace';

var data = [],
	dom = {},
	current = 0,
	next = 0,
	currentPost = {},
	nextPost = {},
	overlayOpen = false;

function init() {

	dom.posts = document.querySelectorAll(".post");

	for (const item of dom.posts) {
		addPost(item)
	}

	dom.postContent = document.querySelectorAll(".post-content");

	for (const item of dom.postContent) {
		item.addEventListener('swipeleft', () => {
			trace.push("swipeleft");
			gotoNext('next');
		}, false);

		item.addEventListener('swiperight',  () => {
			trace.push("swiperight");
			gotoNext('back');
		}, false);

		let close = item.querySelector(".close");
		close.addEventListener('click', (event) => {
			closeOverlay(event.currentTarget.getAttribute('data-id'));
		}, false);

		let right =item.querySelector(".right");
		right.addEventListener('click', () => {
			gotoNext('next');
		}, false);

		let left = item.querySelector(".left");
		left.addEventListener('click', () => {
			gotoNext('back');
		}, false);
	}

	dom.postOverlay = document.querySelector("#post-overlay");

}

function addPost(entry) {

	//trace.push("addPost entry = " + entry);
	//console.dir(entry)

	var id = entry.getAttribute('data-postid');
	//trace.push("addPost id = " + id);
	data.push({ "id": id, "loaded":false });

	entry.addEventListener('click', (event) => {
		event.stopPropagation();
		event.preventDefault();
		var id = parseInt(event.currentTarget.getAttribute('data-postid'));
		loadPost(id);
	}, false);

}
function loadPost(id) {

	trace.push("loadPost id = " + id);

	for (var i = 0; i < data.length; i++) {
		if (id == data[i].id) {
			current = i;
		}
	}

	let post = document.querySelector('#post-'+id);
	//console.dir(post);
	nextPost = post;
	let cat = post.getAttribute('data-cat');

	let imgHeader = post.getAttribute('data-header');
	let imgHires = post.getAttribute('data-hires');
	let imgFile = post.getAttribute('data-img');
	let imgW = post.getAttribute('data-img-w');
	let imgH = post.getAttribute('data-img-h');
	let imgRatio = imgW / imgH;
	trace.push('imgRatio = ' + imgRatio);

	let vidVimeoId = post.getAttribute('data-vimeoid');
	let vidYouTubeId = post.getAttribute('data-vidid');
	let vidFile = post.getAttribute('data-vidfile');

	let playlist = post.getAttribute('data-playlist');

	let isVid = false;
	if((vidYouTubeId != undefined && vidYouTubeId != "") || (playlist !== undefined && playlist !== "") || (vidVimeoId != undefined && vidVimeoId != "") || (vidFile != undefined && vidFile != "")) {
		isVid = true;
	}

	if (!overlayOpen) openOverlay();

	if (isVid) {

		let vidEmbed = ""

		if (vidYouTubeId != undefined && vidYouTubeId != "") {
			vidEmbed = '<iframe src="https://www.youtube.com/embed/' + vidYouTubeId + '" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
		if (playlist !== undefined && playlist !== "") {
			vidEmbed = '<iframe src="https://www.youtube.com/embed/videoseries?list=' + vidYouTubeId + '" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
		if (vidVimeoId != undefined && vidVimeoId != "") {
			vidEmbed = '<iframe src="https://player.vimeo.com/video/' + vidVimeoId + '" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
		}

		if (vidFile != undefined && vidFile != "") {
			vidEmbed = '<video width="100%" height="100%" controls autoplay><source src="'+vidFile+'" type="video/mp4">Your browser does not support the video tag.</video>';
		}

		

		var videoPlayer = document.createElement('DIV');
		videoPlayer.setAttribute('class', 'vid');
		videoPlayer.innerHTML = vidEmbed;

		const figure = post.querySelector('figure');
		figure.prepend(videoPlayer);

		openPost(id);
		return;


	}

	if(data[current].loaded) {
		openPost(id);
		return;
	}
	
	let imgClass = "post-header-img";
	if (cat == "gallery" || cat =="photography" || cat =="photos") {
		imgHeader = imgFile;
		imgClass = "post-img";
		if (imgRatio < 0.7) imgClass = "post-img-tall";
	}
	
	const img = document.createElement('IMG');
	img.addEventListener("load", () => {
		data[current].loaded = true;
		openPost(id);
	});
	img.setAttribute('src', imgHeader);
	img.setAttribute('class', imgClass);

	if (cat == "gallery" || cat =="photography" || cat =="photos") {
		const figure = post.querySelector('figure');
		
		trace.push(figure);

		if (imgHires != undefined && imgHires != "") {
			let hiresLink = document.createElement('a');
			hiresLink.setAttribute('href', imgHires);
			hiresLink.setAttribute('target', '_blank');
			hiresLink.prepend(img);
			trace.push(hiresLink);
			figure.prepend(hiresLink);
		} else {
			figure.prepend(img);
		}
	} else {
		const header = post.querySelector('.post-header-img');
		header.prepend(img);
	}

}

function openOverlay() {
	overlayOpen = true;
	trace.push('openOverlay');
	dom.postOverlay.classList.add('active');
}

function closeOverlay() {
	overlayOpen = false;
	trace.push('closeOverlay');
	dom.postOverlay.classList.remove('active');
	//TweenMax.to(dom.postOverlay, 0.5, { opacity: 0, onComplete: utils.divDisplay, onCompleteParams: [undefined, 'none', dom.postOverlay], ease: "Power1.easeIn", overwrite: 2 });
	closePost();
}

function openPost() {

	trace.push('openPost');

	nextPost.classList.add('active');
	//TweenMax.to(nextPost, 0.5, { opacity: 1, onStart: utils.divDisplay, onStartParams: [undefined, 'block', nextPost], ease: "Power1.easeIn", overwrite: 2 });
	currentPost = nextPost;
}

function closePost() {
	trace.push("closePost " + currentPost);
	currentPost.classList.remove('active');
	setTimeout(removePost, 500);
	//TweenMax.to(currentPost, 0.5, { opacity: 0, onComplete: site.posts.hidePost, ease: "Power1.easeIn", overwrite: 2 });
}

function removePost() {
	trace.push('removePost');
	//console.dir(currentPost);
	let videoPlayerHolder = currentPost.querySelector('.vid');
	if(videoPlayerHolder) videoPlayerHolder.remove();

}

function gotoNext(direction) {
	trace.push("gotoNext direction = " + direction+" current = "+current);
	if (direction == "next") {
		next = current + 1;
	} else {
		next = current - 1;
	}
	trace.push("next = " + next);
	if (next < 0) next = data.length - 1;
	if (next > data.length - 1) next = 0;
	trace.push("next = " + next);
	closePost();

	setTimeout(function(){ loadPost(data[next].id) }, 500);
	//TweenMax.delayedCall(0.5, site.posts.loadPost, [data[next].id]);

}


document.addEventListener("DOMContentLoaded", function () {
	init();
});


