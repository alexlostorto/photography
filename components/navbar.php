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
    /* DESKTOP */
    #navbar-desktop {
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

    #navbar-desktop ul li a#contact:hover {
        background-color: var(--tertiary);
    }

    /* MOBILE */
    #navbar-mobile {
        display: none !important;
        padding: 2rem;
    }

    #navbar-mobile #navbar-logo svg {
        height: 3rem;
    }

    @media only screen and (max-width: 768px) {
        #navbar-desktop {
            display: none !important;
        } 

        #navbar-mobile {
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
        <li><a href="/photography/about/">about</a></li>
        <li><a href="/photography/albums/">albums</a></li>
        <li><a id="contact" href="/photography/contact/">contact</a></li>
    </ul>
</nav>
<nav id="navbar-mobile" class="position-absolute w-100 d-flex flex-row align-items-center justify-content-between">
    <div id="navbar-logo">
        <?php include(getRelativePath("photography/assets/svg/logo-short.svg", $parentTraversals)); ?>
    </div>
</nav>