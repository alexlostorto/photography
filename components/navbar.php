<?php

// PREVENT DIRECT ACCESS
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    // The file is being accessed directly
    http_response_code(403);
    header("Location: /photography/403/");
    exit;
}
// PREVENT DIRECT ACCESS

if (!isset($parentTraversals) || $parentTraversals == null) {
    $parentTraversals = 0;
}

function getRelativePath($absolutePath, $parentTraversals) {
    return str_repeat('../', $parentTraversals) . $absolutePath;
}

?>

<style>
    body.block-scroll {
        overflow: hidden;
    }

    /* DESKTOP */
    #navbar-desktop {
        background-color: var(--primary);
        display: flex !important;
        padding: 2rem;
    }

    #navbar-desktop #navbar-logo svg {
        height: 3rem;
    }

    #navbar-desktop ul {
        list-style: none;
        margin: 0;
    }

    #navbar-desktop ul li a {
        transition: all 0.2s ease-in-out;
        border-radius: 5px;
        color: var(--accent);
        font-family: 'Poppins', sans-serif;
        padding: 0.5rem 1rem;
    }

    #navbar-desktop ul li a:hover {
        color: var(--primary);
        background-color: var(--secondary);
    }

    #navbar-desktop ul li a.contact:hover {
        background-color: var(--tertiary);
    }

    /* MOBILE */
    #navbar-mobile {
        background-color: var(--primary);
        display: none !important;
        padding: 2rem;
        z-index: 9999;
    }

    #navbar-mobile #navbar-logo svg {
        height: 2.5rem;
    }

    #navbar-mobile #hamburger .line {
        height: 3px;
        background-color: var(--accent);
        border-radius: 5px;
        display: block;
        margin: 8px 0 8px auto;
        -webkit-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    #navbar-mobile #hamburger:hover {
        cursor: pointer;
    }

    #navbar-mobile #hamburger.active .line:nth-child(2) {
        opacity: 0;
    }

    #navbar-mobile #hamburger.active .line:nth-child(1) {
        -webkit-transform: translateY(13px) rotate(45deg);
        -ms-transform: translateY(13px) rotate(45deg);
        -o-transform: translateY(13px) rotate(45deg);
        transform: translateY(10px) rotate(45deg);
    }

    #navbar-mobile #hamburger.active .line:nth-child(3) {
        width: 50px !important;
        -webkit-transform: translateY(-13px) rotate(-45deg);
        -ms-transform: translateY(-13px) rotate(-45deg);
        -o-transform: translateY(-13px) rotate(-45deg);
        transform: translateY(-13px) rotate(-45deg);
    }

    #navbar-links-mobile {
        display: none !important;
        position: sticky !important;
        top: 0;
        overflow: hidden;
        height: 0;
        padding: 0;
        z-index: 999;
        background-color: var(--primary);
        transition: height 0.6s ease-in-out;
        list-style: none;
        gap: 3rem;
    }

    #navbar-links-mobile li a {
        transition: all 0.2s ease-in-out;
        border-radius: 5px;
        color: var(--accent);
        font-family: 'Poppins', sans-serif;
        padding: 0.5rem 1rem;
    }

    #navbar-links-mobile li a:hover {
        color: var(--primary);
        background-color: var(--secondary);
    }

    #navbar-links-mobile li a.contact:hover {
        background-color: var(--tertiary);
    }

    #navbar-links-mobile.active {
        height: 100%;
    }

    @media only screen and (max-width: 768px) {
        #navbar-desktop {
            display: none !important;
        } 

        #navbar-mobile {
            display: flex !important;
        }

        #navbar-links-mobile {
            display: flex !important;
        }
    }
</style>

<nav id="navbar-desktop" class="position-absolute w-100 d-flex flex-row align-items-center justify-content-between">
    <div id="navbar-logo">
        <?php include(getRelativePath("photography/assets/svg/logo.svg", $parentTraversals)); ?>
    </div> 
    <ul id="navbar-links" class="d-flex flex-row align-items-center justify-content-between">
        <li><a href="/photography/">home</a></li>
        <!-- <li><a href="/photography/about/">about</a></li> -->
        <li><a href="/photography/albums/">albums</a></li>
        <li><a class="contact" href="/photography/contact/">contact</a></li>
    </ul>
</nav>
<nav id="navbar-mobile" class="position-absolute w-100 d-flex flex-row align-items-center justify-content-between">
    <div id="navbar-logo">
        <?php include(getRelativePath("photography/assets/svg/logo-short.svg", $parentTraversals)); ?>
    </div>
    <div id="hamburger" onclick="this.classList.toggle('active'); document.getElementById('navbar-links-mobile').classList.toggle('active'); document.body.classList.toggle('block-scroll');">
        <span class="line" style="width: 50px;"></span>
        <span class="line" style="width: 35px;"></span>
        <span class="line" style="width: 20px;"></span>
    </div>
</nav>
<ul id="navbar-links-mobile" class="d-flex flex-column align-items-center justify-content-center w-100">
    <li><a href="/photography/">home</a></li>
    <!-- <li><a href="/photography/about/">about</a></li> -->
    <li><a href="/photography/albums/">albums</a></li>
    <li><a class="contact" href="/photography/contact/">contact</a></li>
</ul>