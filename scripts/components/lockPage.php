<?php

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
        padding: 5rem 1rem 2rem;
    }

    main h1 {
        font-family: "Poppins", sans-serif;
        font-size: 3.5rem;
        font-weight: 300;
        margin-bottom: 1rem;
    }

    #password-input {
        width: 15rem;
        padding: 0.4rem 0.5rem;
        border-radius: 5px;
        border: 2px solid var(--accent);
    }

    #password label,
    #password input,
    #password-message {
        font-family: 'Poppins', sans-serif;
        font-weight: 300;
    }

    #password-message {
        display: none;
        color: red;
        position: absolute;
        left: -5rem;
        top: 50%;
        transform: translateY(-50%);
    }

    #password svg {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        height: 1.3rem;
    }

    #password .eye-closed {
        height: 1.4rem;
    }

    #password svg:hover {
        cursor: pointer;
    }

    #password .eye-closed {
        display: none;
    }

    #password button {
        width: 15rem;
        padding: 0.3rem 0.5rem;
        text-align: center;
        background-color: var(--accent);
        border-radius: 5px;
        color: var(--primary);
        margin-top: 1rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 300;
        letter-spacing: 0.05rem;
        transition: all 0.1s ease-in-out;
    }

    #password button.disabled {
        opacity: 0.6;
    }

    #password button:hover {
        cursor: pointer;
        background-color: var(--secondary);
        color: var(--primary);
    }

    @media only screen and (max-width: 768px) {
        #password-message {
            left: 50%;
            top: 450%;
            transform: translate(-50%, -50%);
        }
    }
</style>

<?php include('../../components/navbar.php'); ?>
<main class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
    <h1 class="position-relative">locked</h1> 
    <form id="password">
        <label for="password-input">Password</label>
        <div class="position-relative">
            <input id="password-input" type="password">
            <?php include('../../assets/svg/eye.svg'); ?>
            <?php include('../../assets/svg/eye-closed.svg'); ?>
            <span id="password-message">Incorrect</span>
        </div>
        <button type="submit">enter</button>
    </form>
</main>

<script>

const incorrect = <?= $incorrect; ?>

function displayIncorrectPassword() {
    document.querySelector("#password-input").style.border = "2px solid red";
    document.querySelector("#password-message").style.display = "block";
}

function resetPasswordInput() {
    document.querySelector("#password-input").style.border = "2px solid var(--accent)";
    document.querySelector("#password-message").style.display = "none";
}

if (incorrect) {
    displayIncorrectPassword();
}

function togglePassword() {
    if (document.querySelector("#password-input").type == "text") {
        document.querySelector("#password-input").type = "password";
        document.querySelector("#password .eye-closed").style.display = "none";
        document.querySelector("#password .eye").style.display = "block";
    } else {
        document.querySelector("#password-input").type = "text";
        document.querySelector("#password .eye-closed").style.display = "block";
        document.querySelector("#password .eye").style.display = "none";
    }
}

document.querySelector("#password .eye").addEventListener("click", togglePassword);
document.querySelector("#password .eye-closed").addEventListener("click", togglePassword);

function simulateButtonClick(button) {
    button.className = "disabled";
    button.disabled = true;
    button.innerHTML = "entering...";
}

document.getElementById("password-input").addEventListener("input", function(event) {
    resetPasswordInput();
})

document.getElementById("password").addEventListener("submit", function(event) {
    event.preventDefault();
    simulateButtonClick(document.querySelector("#password button"));
    window.location.href = window.location.href + '?p=' + document.getElementById("password-input").value;
});

function cleanURL() {
    const currentURL = window.location.href;
    const cleanURL = currentURL.split('?')[0];  // Remove query strings (everything after '?')
    window.history.replaceState(null, null, cleanURL);  // Use the History API to update the URL without a page refresh
}

cleanURL();

</script>

<?php include('../../components/footer.php'); ?>