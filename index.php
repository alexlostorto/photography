<?php

$seo_keywords = 'alexlostorto, Alex, Alex lo Storto, Alex Lo Storto, flashi, Flashi, flashcards, flashcard, revision, learning, science, physics, math, chemistry, revision tool, revision tools';
$seo_description = "Revising couldn't be simpler!";
$seo_author = 'Alex lo Storto';
$site_title = 'Alex lo Storto';

$title = 'Alex lo Storto';

// Absolute paths don't work for some reason
$parentTraversals = 1;

include('./components/header.php');

?>

<style>
    html,
    body {
        width: 100%;
        height: 100%;
        overflow: hidden;
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
        padding: 7rem 2rem 2rem 1rem;
    }

    main #side-text {
        width: 40%;
    }

    main #side-text h2 {
        letter-spacing: 0.1rem;
        font-family: "Quicksand", sans-serif;
        margin-right: 4rem;
        font-size: 1.7rem;
        font-weight: 300;
    }

    main #side-text h1 {
        font-family: "Poppins", sans-serif;
        font-size: 3.8rem;
        font-weight: 300;
    }

    main #side-text p {
        font-family: "Quicksand", sans-serif;
        font-size: 1.5rem;
        margin-top: 0.3rem;
        margin-left: 10rem;
        padding: 0.1rem 1rem;
        border: solid var(--accent) 2px;
    }

    main #gallery {
        height: 100%;
        width: 70%;
        display: grid;
        grid-template-columns: 1fr 1.8fr 1fr; /* 3 columns with equal width */
        grid-template-rows: 1fr 1fr; /* 2 rows with equal height */
        grid-gap: 10px; /* Add a gap between grid items */
    }

    main #gallery img {
        overflow: hidden;
        width: 100%; /* Ensure the image takes up the available space */
        height: 100%;
        object-fit: cover;
    }

    main #gallery .large {
        grid-column: span 2;
    }

</style>

<?php include('./components/navbar.php'); ?>
<main class="w-100 h-100 d-flex align-items-center justify-content-between">
    <div id="side-text" class="d-flex flex-column align-items-center justify-content-center">
        <h2>PHOTOGRAPHY</h2>
        <h1>what I do</h1>
        <p>nature</p>
    </div>
    <section id="gallery">
        <img src="./gallery/home/1.jpg" alt="">
        <img class="large" src="./gallery/home/2.jpg" alt="">
        <img class="large" src="./gallery/home/3.jpg" alt="">
        <img src="./gallery/home/4.jpg" alt="">
    </section>
</main>

<?php include('./components/footer.php'); ?>