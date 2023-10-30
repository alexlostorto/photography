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

    main #side-text #theme-overflow {
        font-family: "Quicksand", sans-serif;
        font-size: 1.5rem;
        margin-top: 0.3rem;
        margin-left: 10rem;
    }

    #theme-overflow {
        overflow: hidden;
        height: 2.8rem;
        padding: 0.1rem 1rem;
        border: solid var(--accent) 2px;
    }

    #theme-container p {
        height: 2.5rem;
        margin-bottom: 2.5rem;
        display: inline-block;
    }

    #theme-container p:first-child {
        animation: text-animation 20s infinite;
    }

    @keyframes text-animation {
        0% {margin-top: 0;}
        16% {margin-top: 0;}
        21% {margin-top: -5rem;}
        37% {margin-top: -5rem;}
        42% {margin-top: -10rem;}
        58% {margin-top: -10rem;}
        63% {margin-top: -5rem;}
        79% {margin-top: -5rem;}
        84% {margin-top: 0;}
        100% {margin-top: 0;}
    }

    @keyframes top-left-animation {
        0% {left: 0;}
        16% {left: 0;}
        21% {left: 100%;}
        37% {left: 100%;}
        42% {left: 200%;}
        58% {left: 200%;}
        63% {left: 100%;}
        79% {left: 100%;}
        84% {left: 0;}
        100% {left: 0;}
    }

    @keyframes top-right-animation {
        0% {top: 0;}
        16% {top: 0;}
        21% {top: 100%;}
        37% {top: 100%;}
        42% {top: 200%;}
        58% {top: 200%;}
        63% {top: 100%;}
        79% {top: 100%;}
        84% {top: 0;}
        100% {top: 0;}
    }

    @keyframes bottom-left-animation {
        0% {top: 0;}
        16% {top: 0;}
        21% {top: -100%;}
        37% {top: -100%;}
        42% {top: -200%;}
        58% {top: -200%;}
        63% {top: -100%;}
        79% {top: -100%;}
        84% {top: 0;}
        100% {top: 0;}
    }

    @keyframes bottom-right-animation {
        0% {left: 0;}
        16% {left: 0;}
        21% {left: -100%;}
        37% {left: -100%;}
        42% {left: -200%;}
        58% {left: -200%;}
        63% {left: -100%;}
        79% {left: -100%;}
        84% {left: 0;}
        100% {left: 0;}
    }

    #gallery {
        height: 100%;
        width: 70%;
        display: grid;
        grid-template-columns: 1fr 1.8fr 1fr; /* 3 columns with equal width */
        grid-template-rows: 1fr 1fr; /* 2 rows with equal height */
        grid-gap: 1rem; /* Add a gap between grid items */
    }

    #gallery .images-container {
        display: flex;
        overflow: hidden;
        width: 100%; /* Ensure the image takes up the available space */
        height: 100%;
    }

    #gallery .images-container img {
        min-height: 100%;
        min-width: 100%;
        object-fit: cover;
    }

    #gallery .images-container.top-left {
        flex-direction: row-reverse;
    }

    #gallery .images-container.top-right {
        flex-direction: column-reverse;
    }

    #gallery .images-container.top-left img {
        position: relative;
        animation: top-left-animation 20s infinite;
    }

    #gallery .images-container.top-right img {
        position: relative;
        animation: top-right-animation 20s infinite;
    }

    #gallery .images-container.bottom-left img {
        position: relative;
        animation: bottom-left-animation 20s infinite;
    }

    #gallery .images-container.bottom-right img {
        position: relative;
        animation: bottom-right-animation 20s infinite;
        flex-direction: row-reverse;
    }

    #gallery .large {
        grid-column: span 2;
    }

    @media only screen and (max-width: 768px) {
        body {
            overflow-y: auto;
        }

        main {
            flex-direction: column;
            padding-right: 1rem;
        }

        #side-text {
            width: auto !important;
            margin: 1rem 0;
        }

        #side-text #theme-overflow {
            height: 2.5rem;
        }

        #side-text #theme-container p {
            z-index: -1;
            height: 2.2rem;
            margin-bottom: 2.2rem;
            font-size: 1.2rem;
        }

        main #side-text h2 {
            margin: 0;
            font-size: 1.4rem;
        }

        main #side-text h1 {
            margin: 0;
            font-size: 3rem;
        }

        main #side-text #theme-overflow {
            margin-left: 0;
        }

        #gallery {
            margin-top: 1rem;
            width: 100%;
        }

        @keyframes text-animation {
            0% {margin-top: 0;}
            16% {margin-top: 0;}
            21% {margin-top: -4.4rem;}
            37% {margin-top: -4.4rem;}
            42% {margin-top: -8.8rem;}
            58% {margin-top: -8.8rem;}
            63% {margin-top: -4.4rem;}
            79% {margin-top: -4.4rem;}
            84% {margin-top: 0;}
            100% {margin-top: 0;}
        }
    }
</style>

<?php include('./components/navbar.php'); ?>
<main class="w-100 h-100 d-flex align-items-center justify-content-between">
    <div id="side-text" class="d-flex flex-column align-items-center justify-content-center">
        <h2>PHOTOGRAPHY</h2>
        <h1>what I do</h1>
        <div id="theme-overflow">
            <div id="theme-container" class="d-flex flex-column text-center position-relative">
                <p>architecture</p>
                <p>nature</p>
                <p>people</p>
            </div>
        </div>
    </div>
    <section id="gallery">
        <div class="images-container top-left">
            <img src="./gallery/home/architecture/1.jpg" alt="">
            <img src="./gallery/home/nature/1.jpg" alt="">
            <img src="./gallery/home/people/1.jpg" alt="">
        </div>
        <div class="images-container large top-right">
            <img src="./gallery/home/architecture/2.jpg" alt="">
            <img src="./gallery/home/nature/2.jpg" alt="">
            <img src="./gallery/home/people/2.jpg" alt="">
        </div>
        <div class="images-container large bottom-left flex-column">
            <img src="./gallery/home/architecture/3.jpg" alt="">
            <img src="./gallery/home/nature/3.jpg" alt="">
            <img src="./gallery/home/people/3.jpg" alt="">
        </div>
        <div class="images-container bottom-right">
            <img src="./gallery/home/architecture/4.jpg" alt="">
            <img src="./gallery/home/nature/4.jpg" alt="">
            <img src="./gallery/home/people/4.jpg" alt="">
        </div>
    </section>
</main>

<?php include('./components/footer.php'); ?>