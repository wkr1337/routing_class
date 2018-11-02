<?php $this->setSiteTitle('Portfolio'); ?>
<?php $this->setLayout('home'); ?>
<?php $this->start('body'); ?>





<div class="header-container">
    <div class="header">
        <p class="pheader">
            <h1 class="h1header">Header</h1>
        </p>
        <p>Mijn naam is Willem, een hardwerkende developer met ervaring in de backend. Ik vind het leuk om
            problemen op te lossen met programmeren en doe dit ook in mijn vrije tijd. Ik wil graag meer ervaring
            opdoen met programmeren. </p>
            
    </div>
</div>
<div class="wrapper">
        <div class="projects-text">
            <h2>My projects</h2>
            <p>Here you can find the projects i have made.</p>
        </div>
        <div class="projects-wrapper">

            <div class="div1">
                <a href="https://github.com/wkr1337/codeGorilla">
                    <p>This is the first project I made in the bootcamp of code Gorilla</p>
                </a>
            </div>
            <div class="div2">
                <a href="https://github.com/wkr1337/portfolio">
                    <p>This is the second project I made in the bootcamp of code Gorilla</p>
                </a>
            </div>
            <div class="div3">
                <p>This is the third project I made in the bootcamp of code Gorilla</p>
            </div>
            <div>
                <p>This is the fourth project I made in the bootcamp of code Gorilla</p>
            </div>
            <div>
                <p>This is the fifth project I made in the bootcamp of code Gorilla</p>
            </div>
            <div>
                <p>This is the sixth project I made in the bootcamp of code Gorilla</p>
            </div>
        </div>

    </div>
    <!-- Skills section! -->
<div class="wrapper2">
        <h2>My Skills</h2><br>

        <p>HTML</p>
        <div class="skills-container">
            <div class="skills-div skills-html">35%</div>
        </div>

        <p>CSS</p>
        <div class="skills-container">
            <div class="skills-div skills-css">20%</div>
        </div>

        <p>JavaScript</p>
        <div class="skills-container">
            <div class="skills-div skills-js">15%</div>
        </div>

        <p>PHP</p>
        <div class="skills-container">
            <div class="skills-div skills-php">25%</div>
        </div>

        <p>Java</p>
        <div class="skills-container">
            <div class="skills-div skills-java">50%</div>
        </div>

        <p>Python</p>
        <div class="skills-container">
            <div class="skills-div skills-python">50%</div>
        </div>

        <p>SQL</p>
        <div class="skills-container">
            <div class="skills-div skills-sql">45%</div>
        </div>

        <p>R</p>
        <div class="skills-container">
            <div class="skills-div skills-r">10%</div>
        </div>

    </div>
    <div class="wrapper3">
        <div class="contact-form-wrapper">
            <div class="contact-form-text">
                <h2>Contact</h2><br>
                <p>This is where you can send me a message :)</p>

            </div>
            <form action="#">
            <div class="contact-form-form">

                <div>
                    <label for="name">First Name</label>
                    <input type="text" id="name" name="first-name" placeholder="Your name..">
                </div>
                <div>
                    <label for="email">Email address</label>
                    <input type="text" id="email" name="email-address" placeholder="Your email address..">
                </div>
                <div>
                    <label for="phone-number">Phone number</label>
                    <input type="text" id="phone-number" name="phone-number" placeholder="Your phone number..">
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Your message.." rows="5" cols="50"></textarea>
                </div>
                <div>
                    <input id="contact-submit-button"type="submit" value="Submit">
                </div>
                </form>
            </div>
        </div>
        <div class="scroll-back-to-top">
            <button class="scroll-back-to-top-button" onclick="scrollToDiv('.header-container')">Back to top</button>
        </div>

    </div>

<?php $this->end('body'); ?>



