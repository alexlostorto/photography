// console.clear();
credits();

/*--------------------------------------------------------------
TABLE OF CONTENTS
----------------------------------------------------------------
1.0 SET-UP
    1.1 FADERS
    1.2 DROPDOWNS
2.0 PAPERSSS
    2.1 DOM ELEMENTS
    2.2 VARIABLES
    2.3 FUNCTIONS
    2.4 EVENT LISTENERS
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1.0 SET-UP
--------------------------------------------------------------*/

    /*------------------------------------------------------------
    |
    | 1.1 FADERS
    |
    ------------------------------------------------------------*/

const splashScreen = document.querySelector('.slide.splash');

fadeIn(splashScreen.querySelector('h3'), 200);

fadeIn(splashScreen.querySelector('.big.header #enter-button'), 500);
new hackerEffect(splashScreen.querySelector('.big.header .header-text'));

fadeIn(splashScreen.querySelector('.small.header #enter-button'), 500);
new hackerEffect(splashScreen.querySelector('.small.header .header-text.first'));
new hackerEffect(splashScreen.querySelector('.small.header .header-text.last'));

splashScreen.querySelector('.big.header #enter-button').addEventListener('click', () => {
    window.location = 'pages/architecture/index.html';
    // splashScreen.style.display = 'none';
});

splashScreen.querySelector('.small.header #enter-button').addEventListener('click', () => {
    window.location = 'pages/architecture/index.html';
    // splashScreen.style.display = 'none';
});
