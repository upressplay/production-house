import trace from '@tvg/trace';

let imgsToLoad = [],
dom = {};

function init() {

    dom.site  = document.querySelector('#site');

    dom.img = document.querySelectorAll('.img-loader');
    trace.push("dom.img = "+dom.img.length);
    trace.dump();

    for (const item of dom.img) {
        
        imgsToLoad.push({"obj":item,"loaded":false});
        const imgFile = item.getAttribute("data-img");
        const imgMobileFile = item.getAttribute("data-img-mobile");
        const title = item.getAttribute("data-title");

        const picture = document.createElement('picture');
        
        if(imgMobileFile) {
            const source = document.createElement('source');
            source.setAttribute('media', '(max-width:750px)');
            source.setAttribute('srcset', imgMobileFile);
            picture.append(source);
        }

        const img = document.createElement('IMG');
        img.addEventListener("load", () => {
            imgLoaded(item);
        });
        img.setAttribute('src', imgFile);
        img.setAttribute('alt', title);

        picture.append(img);

        item.prepend(picture);
    }
}
function imgLoaded(obj) {

    var fullLoad = true;
    for (const item of imgsToLoad) {
        if(item.obj == obj) {
            item.loaded = true;    
            item.obj.classList.add('active');
        }
        if(!item.loaded) fullLoad = false;
    }
    trace.push('fullLoad = '+fullLoad)    
   if(fullLoad) {
       dom.site.classList.add('active');
   }
}
document.addEventListener("DOMContentLoaded", function () {
	init();
});