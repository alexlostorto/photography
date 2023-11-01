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
        padding: 7rem 1rem 2rem;
    }

    main h1 {
        font-family: "Poppins", sans-serif;
        font-size: 2.5rem;
        font-weight: 300;
        margin: 1.5rem 0 5rem -2rem;
    }

    #gallery {
        height: auto;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr; /* 2 columns with equal width */
        grid-auto-rows: auto; 
        grid-gap: 1rem; /* Add a gap between grid items */
        padding-bottom: 1rem;
    }

    #gallery > a {
        display: block;
        width: 100%;
        height: 100%;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }

    #gallery > a > svg {
        position: absolute !important;
        font-family: 'Poppins', sans-serif;
        transition: all 0.2s ease-in-out;
        font-weight: 400;
        height: clamp(2rem, 20%, 3rem);
        top: 1rem;
        right: 0.5rem;
        color: var(--primary);
    }

    #gallery > a > img {
        filter: saturate(0);
        object-fit: cover;
        width: 100%;
        height: 100%;
        vertical-align: middle;
        border-radius: 5px;
        transition: all 0.1s ease-in-out;
    }

    #gallery > a > .overlay {
        content: '';
        position: absolute !important;
        width: 100%;
        height: 50%;
        bottom: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0));
        opacity: 0;
    }

    #gallery > a > .overlay > span {
        position: absolute !important;
        font-family: 'Poppins', sans-serif;
        transition: all 0.2s ease-in-out;
        font-weight: 400;
        bottom: 0;
        left: 1rem;
        color: var(--primary);
    }

    #gallery > a:hover > .overlay {
        opacity: 1;
    }

    #gallery > a:hover > .overlay > span {
        bottom: 1rem;
    }

    #gallery > a:hover > img {
        filter: saturate(1);
    }

    @media only screen and (max-width: 768px) {
        main h1 {
            margin: 0 0 2rem;
        }

        main h1::after {
            content: none;
        }

        #gallery > a > .overlay {
            opacity: 1;
        }

        #gallery > a > .overlay > span {
            bottom: 1rem;
        }

        #gallery {
            grid-template-columns: 1fr; /* 1 column */
        }

        #gallery > a > img {
            filter: saturate(1);
        }
    }

    @media only screen and (min-width: 1500px) {
        #gallery {
            grid-template-columns: 1fr 1fr 1fr; /* 3 columns with equal width */
        }
    }
</style>

<?php include('../components/navbar.php'); ?>
<main class="w-100 h-100 d-flex flex-column align-items-center">
    <h1 class="position-relative">albums</h1> 
    <section id="gallery" class="d-grid justify-content-center"></section>
</main>

<script>

function loadAlbums() {
    const apiUrl = '../scripts/getAlbums.php';
    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    };

    // Send the POST request
    fetch(apiUrl, requestOptions)
    .then(response => response.text()) // Convert the response to text
    .then(html => {
        document.getElementById("gallery").innerHTML = html;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

loadAlbums();

</script>

<?php include('../components/footer.php'); ?>