<?php

// PREVENT DIRECT ACCESS
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    // The file is being accessed directly
    http_response_code(403);
    header("Location: /photography/403/");
    exit;
}
// PREVENT DIRECT ACCESS

$seo_keywords = 'alexlostorto, Alex, Alex lo Storto, Alex Lo Storto, photography, fine arts, nature, architecture, portfolio, photography portfolio, photographer, photos, headshots';
$seo_description = "Capturing memories so they last forever ✨";
$seo_author = 'Alex lo Storto';
$site_title = 'Alex lo Storto';

$title = 'Alex lo Storto';

// Absolute paths don't work for some reason
$parentTraversals = 3;

include('../../components/header.php');

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
        font-weight: 400;
        margin: 1rem 0 0;
    }

    main h2 {
        font-family: "Quicksand", sans-serif;
        font-size: 1.5rem;
        font-weight: 300;
        margin: 0.5rem 0;
    }

    main .album-stats {
        position: relative;
        margin: 1rem 0 4rem;
    }

    main .album-stats #image-count,
    main .album-stats #view-count {
        flex: 1;
    }

    main .album-stats #image-count span,
    main .album-stats #view-count span {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.2rem;
    }

    main .album-stats #image-count {
        justify-content: end;
    }

    main .album-stats #view-count {
        gap: 0.3rem;
    }

    main .album-stats #image-count svg,
    main .album-stats #view-count svg {
        height: 1.5rem;
    }

    main .album-stats .privacy {
        content: 'public';
        font-family: 'Quicksand', sans-serif;
        font-weight: 400;
        padding: 0.3rem 1.5rem;
        border-radius: 50px;
        color: var(--accent);
        border: 2px solid var(--accent);
        font-size: 1.3rem;
    }

    #gallery {
        height: auto;
        width: 100%;
        flex-wrap: wrap;
        gap: 1rem;
        padding-bottom: 1rem;
    }

    #gallery::after {
        content: "";
        flex-basis: 500px;
    }

    #gallery > div {
        overflow: hidden;
        position: relative;
        flex: 1 1 auto;
        height: 500px;
    }

    #gallery > div > img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        vertical-align: middle;
        border-radius: 5px;
    }

    @media only screen and (max-width: 768px) {
        #gallery > div {
            height: auto;
            width: 100%;
        }
    }

    @media only screen and (min-width: 1200px) {
        #gallery > div{
            height: 300px;
        }
    }

    @media only screen and (min-width: 1500px) {
        #gallery > div{
            height: 400px;
        }
    }
</style>

<?php include('../../components/navbar.php'); ?>
<main class="w-100 h-100 d-flex flex-column align-items-center">
    <h1 class="position-relative text-center"><?= $name; ?></h1> 
    <h2><?= $description; ?></h2>
    <div class="album-stats d-flex align-items-center justify-content-center w-100">
        <div id="image-count" class="d-flex align-items-center mx-3">
            <?php include('../../assets/svg/image.svg'); ?>
            <span>0</span>
        </div>
        <span class="privacy"><?= $privacy; ?></span>
        <div id="view-count" class="d-flex align-items-center mx-3">
            <span><?= $views ?></span>
            <?php include('../../assets/svg/eye.svg'); ?>
        </div>
    </div>
    <section id="gallery" class="d-flex justify-content-center">
        <?php loadImages(); ?>
    </section>
</main>

<script>

function updateImageCount() {
    const imageCount = document.querySelectorAll('#gallery img').length;
    document.querySelector('#image-count span').textContent = imageCount;
}

updateImageCount();

</script>

<?php include('../../components/footer.php'); ?>