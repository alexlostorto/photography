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

const lockScreen = document.querySelector('.slide.lock');
const mainScreen = document.querySelector('.slide.main');

const urlParams = new URLSearchParams(window.location.search);
const pass = urlParams.get('p');

if (md5(pass) == '5ebe2294ecd0e0f08eab7690d2a6ee69') {
    lockScreen.style.display = 'none';
    mainScreen.style.display = 'flex';
}
