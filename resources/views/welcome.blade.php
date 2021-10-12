<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .top-left {
                position: absolute;
                left: 10px;
                top: 18px;
            }

            .content {
                max-width: 800px;
                padding: 20px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    ProPay Assessment
                </div>
                <b>Assessment:</b>
                <p>The candidate will need to create the following:</p>
                <p>A web-based system where a user can log in and out of the system to manage people via CRUD operations.
                Herewith the fields that need to be managed: (all fields are required)</p>

                <p>* Name* Surname* South African Id Number* Mobile Number* Email Address* Birth Date* Language (Single Selection)* Interests (Multiple Selection)
                On capturing a person: An email needs to be sent out to the person captured informing them that they’ve been captured on the system.</p>
                <p>If using a framework: Fire an event that triggers a job.</p>
                <p>If using vanilla PHP: Simply send out an email.</p>
                <p><br><b>Using the following:</b></p>
                    <ul>
                        <li>PHP >= 7.1.3</li>
                        <li>MySQL >= 5.1</li>
                        <li>Apache or Nginx (system needs to be able to work on a virtual host)</li>
                        <li> HTML, CSS and JavaScript</li>
                        <li>Bootstrap and jQuery can be leveraged if need be.</li>
                    </ul>
                    <p>Vanilla PHP will be accepted, but it is advantageous to use a modern framework like Laravel. (You’re going to have to really know what you’re doing if you’re going to roll your own functionality)</p>
                    <p>If you’re using CakePHP, please don’t “bake” everything together.</p>
                    <p>If you’re using Drupal, Joomla or WordPress: You need not send the assessment. Your journey can safely stop here.</p>
                    <p> If there are no migrations or seeds, kindly provide the SQL file for us to dump.</p>
                    <p>The username and password for the web app also need to be provided, please. (We can’t seem to figure out encrypted passwords)</p>
                    <p>Pro-Tip! Avoid hard-coding values and duplicating code. Spaghetti code is also a big no-no. Hacking someone else’s GitHub / Bitbucket project isn’t going to fly either.</p>
                    <P>Yet another Pro-Tip! Your application actually needs to work. Clear all migrations, rerun and test your application again.</P>
                    <p>Kindly provide your assessment via any cloud platform after completion. Our mail server blocks any incoming compressed files.</p>
            </div>
        </div>
    </body>
</html>
