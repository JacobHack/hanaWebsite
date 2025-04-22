<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://jacobhack.github.io/hanaWebsite/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>Home Page</title>
</head>
<body>
    <nav class="navbar sticky-top">
        <ul class="nav-list">
            <li><a href= "./login/login_register_modal.html">Logout</a></li>
            <li><a href="home.php">Timeline</a></li>
            <li><a href="definitions.php">Definitions</a></li>

            <?php
                session_start();
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    echo '<li><a href="/hanawebsite/login/dashboard.php">Admin Dashboard</a></li>';
                }
            ?>
        </ul>
    </nav>
    <!---
    <div>
        <p class="testclass" id="test1"> test1 </p>
        <p id="demo" > </p>
    </div>
    --->
    <div class="container">
        <div class="main-timeline">

                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/1940s.php"><div class="date-content">
                                        <div class="date-outer" id="1940s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                                    <span class="year">1940s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 1940s were shaped by events such as the Holocaust, World War II, and the beginning of the Cold War. Driven by war and rapid industrialization, the world experienced significant changes socially, medically, economically, and politically.                                       
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->
        
                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/1950s.php"><div class="date-content" >
                                        <div class="date-outer" id="1950s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                            <span class="year">1950s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 1950s were defined by events such as the period of economic strength that came after World War II, more specifically in the United States the 50s were defined by cultural transformations that were coming out of the Civil Rights Movement and the Cold War.                                        
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->
        
                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/1960s.php"><div class="date-content" >
                                        <div class="date-outer" id="1960s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                            <span class="year">1960s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 1960s was a period of time that experienced events such as the Vietnam War, and in the United States the 60s was a time of continued activism in regards to Civil Rights. In this period political protests in the U.S. were common and many important figures such as President John F. Kennedy and civil rights activist Martin Luther King were assassinated.                                        
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->
        
                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/1970s.php"><div class="date-content" >
                                        <div class="date-outer" id="1970s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                            <span class="year">1970s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 1970s was an era of major technological and scientific advances. In the United States perhaps the most well known event was the Watergate Scandal which led to public mistrust in the U.S. government.
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->

                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/1980s.php"><div class="date-content" >
                                        <div class="date-outer" id="1980s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                            <span class="year">1980s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 1980s were shaped by events such as the end of the Cold War, a worldwide adoption of conservative ideals, the beginning of the AIDS epidemic, the fall of the Berlin Wall and the creation of the internet.                                         
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->

                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/1990s.php"><div class="date-content" >
                                        <div class="date-outer" id="1990s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                            <span class="year">1990s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 1990s were defined by events such as the rise of the internet, and the fall of the Soviet Union. It was a decade of newfound communication, business, and entertainment that sprouted from technological, social, and cultural developments.                                        
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->

                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/2000s.php"><div class="date-content" >
                                        <div class="date-outer" id="2000s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                            <span class="year">2000s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 2000s was an era marked by events such as the Iraq War, economic shifts, the 9/11 attacks in New York, the Great Recession, and the explosion of use of social media and the internet. It was a decade of technological advancement and in the U.S. was a decade that was shaped by the attacks on 9/11, Hurricane Katrina, and the Great Recession.                                        
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->

                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/2010s.php"><div class="date-content" >
                                        <div class="date-outer" id="2010s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                            <span class="year">2010s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 2010s were a decade shaped by more technologically centered events than seen before. It was a decade shaped by the adoption of smartphones, the popularity of platforms online such as FaceBook and Twitter, and the affirmation of same-sex marriage in many countries such as the United States.                                        
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->

                                <!-- start experience section-->
                                <div class="timeline">
                                    <div class="icon"></div>
                                    <a href="decades/2020s.php"><div class="date-content">
                                        <div class="date-outer" id="2020s">
                                            <span class="date">
                                                    <span class="month">The</span>
                                            <span class="year">2020s</span>
                                            </span>
                                        </div>
                                    </div></a>
                                    <div class="timeline-content">
                                        <h5 class="title">Decade Summary</h5>
                                        <p class="description">
                                            The 2020s has been a decade shaped by events such as the COVID-19 pandemic. In the United States, the murder of George Floyd and other social events have shaped the country culturally, socially, and politically.                                        
                                        </p>
                                    </div>
                                </div>
                                <!-- end experience section-->
                                
                            </div>
        </div>
    
    
</body>
</html>