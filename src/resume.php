<div id="resume">
    <?php 

        $headshot = get_field('headshot');
        $name = get_field('name');
        $position = get_field('title');
        $resumeFile = get_field('resume-file');
        $resume = get_field('resume');
        $excerpt =  get_the_excerpt( );
        $skills = get_field('skills');
        $experience = get_field('experience');
        $projects = get_field('projects');
        $education = get_field('education');
        $bio = get_field('bio');
        $accomplishments = get_field('accomplishments');
        $resume = get_field('resume');
    ?>
    <section class="resume-card">
        <?php if($headshot) : ?> 
            <a href="<?php echo $headshot['sizes']['large']; ?>" target="_blank">
                <img src="<?php echo $headshot['sizes']['sq']; ?>"/>
            </a>
        <?php endif; ?>
        <?php if($name) : ?> 
            <h2 class="headline-font">
                <?php echo $name; ?> 
            </h2>
        <?php endif; ?>
        <?php if($position) : ?>
            <h3>   
                <?php echo $position; ?>
            </h3>
        <?php endif; ?>
        <?php if($resumeFile) : ?>  
            <a href="<?php echo $resumeFile['url']; ?>  " target="_blank" class="resume">
            <i class="fa fa-file-text" aria-hidden="true"></i> Download Resume</a>
        <?php endif; ?>   
        
    </section>

    <?php if($resume) : ?>
        <section class="resume-card">
            <?php echo $resume; ?>
        </section>
    <?php endif; ?>

    <?php if($skills) : ?>
        <section class="resume-card">
            <h4 class="headline-font">Skills </h4>
            <?php echo $skills; ?>
        </section>
    <?php endif; ?>
    <?php if($bio) : ?>
        <section class="resume-card">
            <h4 class="headline-font">Bio</h4>
            <p>
                <?php echo $bio; ?>
            </p>
        </section>
    <?php endif; ?>
    <?php if($experience) : ?> 
        <section class="resume-card">
            <h4 class="headline-font">Experience </h4>
            <?php foreach ( $experience as $e ) : ?>
            <div class="block">
                <strong><?php echo $e['title']; ?></strong><br/>
                <?php if($e['company']) : ?>
                    <?php echo $e['company']; ?><br/>
                <?php endif; ?>
                <?php if($e['location']) : ?>
                    <?php echo $e['location']; ?><br/>
                <?php endif; ?>
                <div class="dates">
                    <?php echo $e['start_date']; ?> - 
                    <?php 
                        if($e['end_date']) {
                            echo $e['end_date'].'<br/>';
                        } 
                    ?>
                    <?php 
                        if($e['current_role']) {
                            echo "Present";
                        } 
                    ?>
                </div><!-- dates -->
                <?php if($e['description']) : ?> 
                    <div class="desc">                     
                        <?php echo $e['description']; ?>
                    </div><!-- desc -->
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
    <?php if($projects) : ?> 
       
            
            <?php foreach ( $projects as $ps ) : ?>
                 <section class="resume-card">
                    <h4 class="headline-font"><?php echo $ps['title'];?> </h4>
                <?php foreach ( $ps['project']as $p ) : ?>
                    <div class="row">
                        <div class="top">
                            <div class="title">
                                <?php echo $p['title']; ?>
                            </div>
                            <div class="role">
                                <?php echo $p['role']; ?>
                            </div>
                            <div class="company">
                                <?php echo $p['company']; ?>
                            </div>
                        </div>
                        <div class="desc">
                            <?php echo $p['description']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>  
                
                </section>
            <?php endforeach; ?>
        
    <?php endif; ?>
    <?php if($education) : ?> 
        <section class="resume-card">
            <h4 class="headline-font">
                Education
            </h4>
            <?php foreach ( $education as $ed ) : ?>
                <div class="block">

                    <?php if($ed['school']) : ?> 
                        <strong><?php echo $ed['school']; ?></strong><br/>
                    <?php endif; ?>
                    <?php if($ed['degree']) : ?> 
                        <?php echo $ed['degree']; ?><br/>
                    <?php endif; ?>
                    <?php if($ed['location']) : ?> 
                        <?php echo $ed['location']; ?><br/>
                    <?php endif; ?>
                    <div class="dates">
                    <?php 
                        if($ed['start_year'] != "") {
                            echo $ed['start_year'].' - ';
                        } 
                    ?>

                    <?php 
                        if($ed['end_year'] != "") {
                            echo $ed['end_year'];
                        } 
                    ?>   
                    </div>
                    <?php if($ed['description'] != "") : ?> 
                        <div class="desc">                     
                            <?php echo $ed['description']; ?>
                        </div><!-- desc -->
                    <?php endif; ?>
                    <?php if($ed['activities'] != "") : ?> 
                        <div class="activities">                     
                            <strong>Activities: </strong><?php echo $ed['activities']; ?>
                        </div><!-- desc -->
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
    <?php if($accomplishments) : ?> 
        <section class="resume-card">
            <h4 class="headline-font">
                Accomplishments
            </h4>
            <?php foreach ( $accomplishments as $a ) : ?>
                <div class="block">
                <strong><?php echo $a['title']; ?></strong><br/>
                
                <?php if($a['issuer'] != "") : ?> 
                    <?php echo $a['issuer']; ?><br/>
                <?php endif; ?>
                <?php if($a['date'] != "") : ?> 
                    <div class="dates">
                        <?php echo $a['date']; ?>
                    </div>
                <?php endif; ?>
                <?php if($a['description'] != "") : ?> 
                    <div class="desc">                     
                        <?php echo $a['description']; ?>
                    </div><!-- desc -->
                <?php endif; ?>
                
            </div>
            <?php endforeach; ?>
        </section><!-- resume-card -->
    <?php endif; ?>

</div><!-- resume -->




