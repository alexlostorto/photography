<?php

$seo_keywords = 'alexlostorto, Alex, Alex lo Storto, Alex Lo Storto, photography, fine arts, nature, architecture, portfolio, photography portfolio, photographer, photos, headshots';
$seo_description = "Capturing memories so they last forever ✨";
$seo_author = 'Alex lo Storto';
$site_title = 'Alex lo Storto';

$title = 'Alex lo Storto';

// Absolute paths don't work for some reason
$parentTraversals = 2;

include('../components/header.php');

?>

<style>
    html,
    body {
        width: 100%;
        height: 100%;
        overflow-x: hidden;
    }

    * {
        font-family: "Raleway", sans-serif;
    }

    input,
    button,
    textarea,
    select {
        margin: 0;
        padding: 0;
        border: none;
        outline: none;
        font-family: inherit;
        font-size: inherit;
        color: inherit;
        background: none;
        appearance: none;
    }

    /* Change selection color */
    ::selection {
        background-color: var(--secondary);
        color: black;
    }

    /* Fallback for older browsers */
    ::-moz-selection {
        background-color: var(--secondary);
        color: black;
    }
</style>

<style>
    main {
        padding: 5rem 1rem 2rem;
    }

    main h1 {
        font-family: "Poppins", sans-serif;
        font-size: 3.5rem;
        font-weight: 300;
        margin-bottom: 1rem;
    }

    #contact-links {
        margin-top: 1.5rem;
        list-style: none;
        padding: 0;
        gap: 1rem;
    }

    #contact-links li {
        text-align: center;
    }

    #contact-links li a {
        font-family: 'Poppins', sans-serif;
        display: block;
        width: 100%;
        height: 100%;
        padding: 0.5rem 0;
        width: 10rem;
        border: 2px solid var(--accent);
        border-radius: 5px;
        text-decoration: none;
        color: var(--accent);
        transition: all 0.2s ease-in-out;
    }

    #contact-links li a:hover {
        background-color: var(--secondary);
        color: var(--primary);
    }
</style>

<?php include('../components/navbar.php'); ?>
<main class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
    <h1 class="position-relative">contact</h1> 
    <ul id="contact-links" class="d-flex flex-column">
        <li><a href="https://youtube.com/@alexlostorto">YouTube</a></li>
        <li><a href="https://www.instagram.com/alexlostorto">Instagram</a></li>
        <li><a href="https://www.tiktok.com/@alexlostorto">TikTok</a></li>
        <li><a href="https://www.linkedin.com/in/alex-lo-storto">LinkedIn</a></li>
    </ul>
</main>

<?php include('../components/footer.php'); ?>