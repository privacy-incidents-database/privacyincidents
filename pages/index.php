<?php include 'layout/header.html';?>

  <!-- Header Carousel -->
  <header id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
          <div class="item active">
              <!--<div class="fill" style="background-image:url('/privacyincidents/assets/imgs/snapchat.jpg');">
              </div>
              <div class="carousel-img">
              	<img src="/privacyincidents/assets/imgs/snapchat.jpg" alt="Snapchat">
              </div>
              <div class="carousel-caption">
                <h3 class="caption">Snapchat's claims of the ephemerality of snaps found to be misleading.</h3>
                <p class="tags">#5/2014, #World, #SnapChat, #UnexpectedProductBehavior, #Citizens</p>
              </div>-->

              <div class="row">
              	<div class="col-md-6" style="margin-left: 20%; margin-right: -25%; margin-top: 3.5%;">
              		<img src="/privacyincidents/assets/imgs/snapchat.jpg" alt="Snapchat" style="width: 45%;">
              	</div>
              	<div class="col-md-6" style="float: left; margin-top: 10.5%; padding-right: 10%;">
              		<h3 class="caption">Snapchat's claims of the ephemerality of snaps found to be misleading.</h3>
                	<p class="tags">#5/2014, #World, #SnapChat, #UnexpectedProductBehavior, #Citizens</p>
              	</div>
              </div>
          </div>
          <!--
          <div class="item">
              <div class="fill" style="background-image:url('/privacyincidents/assets/imgs/president.jpg');">
              </div>
              <div class="carousel-caption">
                <h3 class="caption">Presidential candidate web sites found to often be poor on privacy (e.g. no privacy policy or inappropriate policies).</h3>
                <p class="tags">#9/2015, #World, #PresidentialCandidateSites, #PrivacyPolicy, #Citizens</p>
              </div>
          </div>
          <div class="item">
              <div class="fill" style="background-image:url('/privacyincidents/assets/imgs/facebook.jpg');">
              </div>
              <div class="carousel-caption">
                <h3 class="caption">Facebook begins using views of pages containing the Like button to target advertising.</h3>
                <p class="tags">#9/2015, #World, #Facebook, #Ads, #UnexpectedProductBehavior, #Citizens</p>
              </div>
          </div>
          <div class="item">
              <div class="fill" style="background-image:url('/privacyincidents/assets/imgs/google_transgender.jpg');">
              </div>
              <div class="carousel-caption">
                <h3 class="caption">Unexpected linking of text to a Google+ account accidentally outed a transgender women when sending a text.</h3>
                <p class="tags">#1/2014, #USA, #Google, #Misunderstanding, #Citizens</p>
              </div>
          </div>-->
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="icon-next"></span>
      </a>
  </header>

  <div class="container">
		<div id="about">
			<h3>About Privacy Incidents Database</h3>
			<p>This project will begin building a database of privacy incidents (as documented in the press and company/organization public statements) so that the analysis needed to answer questions such as, "What is the most common cause of privacy incidents? What Internet company impacts the most users through privacy mishaps?" can be done in a repeatable, transparent manner. The database will be crowd-sourced, but moderated, to ensure past and future privacy incidents are represented without duplication.</p>				
		</div>
		<div id="definitions">
			<h3>What is a privacy incident?</h3>
			<p><span class="bold-text">Contained Digital Privacy Incident</span>: One-time/contained events involving the accidental or unauthorized collection, use or exposure of sensitive digital information or events creating the perception that unauthorized collection, use or exposure of sensitive digital information is likely. Example: <a href="http://www.theguardian.com/technology/2015/sep/02/london-clinic-accidentally-reveals-hiv-status-of-780-patients">London clinic accidentally discloses names and email addresses of patients</a></p>

			<p><span class="bold-text">Extended Internet Digital Incident</span>: A privacy incident as defined above, that has a clear start date, but either (1) still ongoing or (2) occurred for a sufficiently long period of time (e.g. months) that it would be confusing to represent it in the same visualizations as one-time events.
Example: <a href="http://www.cultofmac.com/157641/this-creepy-app-isnt-just-stalking-women-without-their-knowledge-its-a-wake-up-call-about-facebook-privacy/">Creation of the Girls Around Me app</a></p>
		
			<p><span class="bold-text">Examples of news items that do not represent either contained or extended privacy incidents
</span>: 
				<ul>
					<li>A company announces a new privacy policy and received a negative response</li>
					<li>A privacy-protecting tool is released, e.g. <a href="http://techcrunch.com/2014/03/25/facebooks-privacy-checkups-remind-users-to-stop-posting-publicly/">Facebook privacy check-ups</a></li>
					<li>A regulatory action like a privacy investigation or settlement, e.g. <a href="http://www.usatoday.com/story/tech/2014/05/08/snapchat-ftc/8853239/">Snapchat’s settlement with the FTC</a>, but should include any change to the way the company operates after the settlement/investigation</li>
				</ul>	
				
			</p>	
		
		</div>
		<div id="projectstatus">
			<h3>Project Status</h3>
			<p>We are currently in the works of examining online resources for privacy incidents to be included in our database. </p>
		</div>
<?php include 'layout/footer.html';?>