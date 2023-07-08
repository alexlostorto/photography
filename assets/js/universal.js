/*--------------------------------------------------------------
TABLE OF CONTENTS
----------------------------------------------------------------
1.0 VARIABLES
    1.1 DOM ELEMENTS
2.0 FUNCTIONS
    2.1 ESSENTIAL
    2.2 VIEW COUNTER
    2.3 FADERS
    2.4 CREDITS
    2.5 HACKER EFFECT
    2.6 MD5
3.0 NAVIGATION
    3.1 HAMBURGER FUNCTIONALITY
4.0 CUSTOM CURSOR
    4.1 DETECT DEVICE
    4.2 CURSOR
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1.0 VARIABLE
--------------------------------------------------------------*/

    /*------------------------------------------------------------
    |
    | 1.1 DOM ELEMENTS
    |
    ------------------------------------------------------------*/

let toggleButton;
let resourcesButton;
let resourcesLinks;
let subcategoryButton;
let navbarItems;
const homePage = document.querySelector('.body-container');
const bodyElement = document.querySelector('body');
const cursor = document.querySelector('.custom-cursor');
const cursorInner = document.querySelector('.custom-cursor.inner');
const cursorOuter = document.querySelector('.custom-cursor.outer');

/*--------------------------------------------------------------
2.0 FUNCTIONS
--------------------------------------------------------------*/

    /*------------------------------------------------------------
    |
    | 2.1 ESSENTIAL
    |
    ------------------------------------------------------------*/

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
}

function isNumeric(str) {
    if (typeof str != "string") return false // we only process strings!  
    return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
            !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}

function round(number, decimalPlaces) {
    return Number(Math.round(number + "e" + decimalPlaces) + "e-" + decimalPlaces)
}

async function waitUntilLoaded(selector) {
    let trials = 0;
    while (document.querySelector(selector) === null && trials <= 10) {
        await sleep(100);
        trials ++;
    }

    return document.querySelector(selector);
}

    /*------------------------------------------------------------
    |
    | 2.2 VIEW COUNTER
    |
    ------------------------------------------------------------*/

async function liveViews() {
    try {
        let response = await(await (fetch("https://api.countapi.xyz/hit/alexlostorto.github.io/papersss"))).json();
        visitsCounter = document.getElementById('visits');
    
        if (visitsCounter !== null) {
            visitsCounter.innerText = response.value + " 👀";
        } else { return }
    } catch(err) {
        console.log(err)
    }
}

liveViews()

    /*------------------------------------------------------------
    |
    | 2.3 FADERS
    |
    ------------------------------------------------------------*/

const faders = document.querySelectorAll('.fade-in');
const appearOptions = {
    threshold: 1,
    rootMargin: "0px 0px -100px 0px"
};

const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll) {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            return
        } else {
            entry.target.classList.add('appear');
            appearOnScroll.unobserve(entry.target);
        }
    })
}, appearOptions);

faders.forEach(fader => {
    appearOnScroll.observe(fader);
})

async function fadeIn(element, delay) {
    await sleep(delay);
    element.classList.toggle("appear");
}

    /*------------------------------------------------------------
    |
    | 2.4 CREDITS
    |
    ------------------------------------------------------------*/

function credits() {
    console.log.apply(console, ["%c Thanks for stopping by! I\u2019m currently looking to expand my programming knowledge and work with other like-minded devs. ","color: #fff; background: #8000ff; padding:5px 0;"])
    console.log.apply(console, ["%c Designed and Developed by Alex lo Storto %c\ud83d\ude80 ","color: #fff; background: #8000ff; padding:5px 0;","color: #fff; background: #242424; padding:5px 0 5px 5px;"])
}

    /*------------------------------------------------------------
    |
    | 2.5 HACKER EFFECT
    |
    ------------------------------------------------------------*/

const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

class hackerEffect {
    constructor(element) {
        this.interval = null;
        this.iteration = 0;
        this.hackerEffect(element);
    }

    hackerEffect(element) { 
        this.interval = setInterval(() => {
            element.innerText = element.innerText
            .split("")
            .map((letter, index) => {
                if (index < this.iteration) {
                    return element.dataset.value[index];
                }
    
                if (letter == ' ') {
                    return ' ';
                }
                
                return letters[Math.floor(Math.random() * 26)]
            }).join("");
    
            if (this.iteration >= element.dataset.value.length) { 
                clearInterval(this.interval);
            }
    
            this.iteration += 1 / 3;
        }, 30);
    }
}

    /*------------------------------------------------------------
    |
    | 2.6 MD5
    |
    ------------------------------------------------------------*/

function md5(inputString) {
    var hc="0123456789abcdef";
    function rh(n) {var j,s="";for(j=0;j<=3;j++) s+=hc.charAt((n>>(j*8+4))&0x0F)+hc.charAt((n>>(j*8))&0x0F);return s;}
    function ad(x,y) {var l=(x&0xFFFF)+(y&0xFFFF);var m=(x>>16)+(y>>16)+(l>>16);return (m<<16)|(l&0xFFFF);}
    function rl(n,c)            {return (n<<c)|(n>>>(32-c));}
    function cm(q,a,b,x,s,t)    {return ad(rl(ad(ad(a,q),ad(x,t)),s),b);}
    function ff(a,b,c,d,x,s,t)  {return cm((b&c)|((~b)&d),a,b,x,s,t);}
    function gg(a,b,c,d,x,s,t)  {return cm((b&d)|(c&(~d)),a,b,x,s,t);}
    function hh(a,b,c,d,x,s,t)  {return cm(b^c^d,a,b,x,s,t);}
    function ii(a,b,c,d,x,s,t)  {return cm(c^(b|(~d)),a,b,x,s,t);}
    function sb(x) {
        var i;var nblk=((x.length+8)>>6)+1;var blks=new Array(nblk*16);for(i=0;i<nblk*16;i++) blks[i]=0;
        for(i=0;i<x.length;i++) blks[i>>2]|=x.charCodeAt(i)<<((i%4)*8);
        blks[i>>2]|=0x80<<((i%4)*8);blks[nblk*16-2]=x.length*8;return blks;
    }
    var i,x=sb(""+inputString),a=1732584193,b=-271733879,c=-1732584194,d=271733878,olda,oldb,oldc,oldd;
    for(i=0;i<x.length;i+=16) {olda=a;oldb=b;oldc=c;oldd=d;
        a=ff(a,b,c,d,x[i+ 0], 7, -680876936);d=ff(d,a,b,c,x[i+ 1],12, -389564586);c=ff(c,d,a,b,x[i+ 2],17,  606105819);
        b=ff(b,c,d,a,x[i+ 3],22,-1044525330);a=ff(a,b,c,d,x[i+ 4], 7, -176418897);d=ff(d,a,b,c,x[i+ 5],12, 1200080426);
        c=ff(c,d,a,b,x[i+ 6],17,-1473231341);b=ff(b,c,d,a,x[i+ 7],22,  -45705983);a=ff(a,b,c,d,x[i+ 8], 7, 1770035416);
        d=ff(d,a,b,c,x[i+ 9],12,-1958414417);c=ff(c,d,a,b,x[i+10],17,     -42063);b=ff(b,c,d,a,x[i+11],22,-1990404162);
        a=ff(a,b,c,d,x[i+12], 7, 1804603682);d=ff(d,a,b,c,x[i+13],12,  -40341101);c=ff(c,d,a,b,x[i+14],17,-1502002290);
        b=ff(b,c,d,a,x[i+15],22, 1236535329);a=gg(a,b,c,d,x[i+ 1], 5, -165796510);d=gg(d,a,b,c,x[i+ 6], 9,-1069501632);
        c=gg(c,d,a,b,x[i+11],14,  643717713);b=gg(b,c,d,a,x[i+ 0],20, -373897302);a=gg(a,b,c,d,x[i+ 5], 5, -701558691);
        d=gg(d,a,b,c,x[i+10], 9,   38016083);c=gg(c,d,a,b,x[i+15],14, -660478335);b=gg(b,c,d,a,x[i+ 4],20, -405537848);
        a=gg(a,b,c,d,x[i+ 9], 5,  568446438);d=gg(d,a,b,c,x[i+14], 9,-1019803690);c=gg(c,d,a,b,x[i+ 3],14, -187363961);
        b=gg(b,c,d,a,x[i+ 8],20, 1163531501);a=gg(a,b,c,d,x[i+13], 5,-1444681467);d=gg(d,a,b,c,x[i+ 2], 9,  -51403784);
        c=gg(c,d,a,b,x[i+ 7],14, 1735328473);b=gg(b,c,d,a,x[i+12],20,-1926607734);a=hh(a,b,c,d,x[i+ 5], 4,    -378558);
        d=hh(d,a,b,c,x[i+ 8],11,-2022574463);c=hh(c,d,a,b,x[i+11],16, 1839030562);b=hh(b,c,d,a,x[i+14],23,  -35309556);
        a=hh(a,b,c,d,x[i+ 1], 4,-1530992060);d=hh(d,a,b,c,x[i+ 4],11, 1272893353);c=hh(c,d,a,b,x[i+ 7],16, -155497632);
        b=hh(b,c,d,a,x[i+10],23,-1094730640);a=hh(a,b,c,d,x[i+13], 4,  681279174);d=hh(d,a,b,c,x[i+ 0],11, -358537222);
        c=hh(c,d,a,b,x[i+ 3],16, -722521979);b=hh(b,c,d,a,x[i+ 6],23,   76029189);a=hh(a,b,c,d,x[i+ 9], 4, -640364487);
        d=hh(d,a,b,c,x[i+12],11, -421815835);c=hh(c,d,a,b,x[i+15],16,  530742520);b=hh(b,c,d,a,x[i+ 2],23, -995338651);
        a=ii(a,b,c,d,x[i+ 0], 6, -198630844);d=ii(d,a,b,c,x[i+ 7],10, 1126891415);c=ii(c,d,a,b,x[i+14],15,-1416354905);
        b=ii(b,c,d,a,x[i+ 5],21,  -57434055);a=ii(a,b,c,d,x[i+12], 6, 1700485571);d=ii(d,a,b,c,x[i+ 3],10,-1894986606);
        c=ii(c,d,a,b,x[i+10],15,   -1051523);b=ii(b,c,d,a,x[i+ 1],21,-2054922799);a=ii(a,b,c,d,x[i+ 8], 6, 1873313359);
        d=ii(d,a,b,c,x[i+15],10,  -30611744);c=ii(c,d,a,b,x[i+ 6],15,-1560198380);b=ii(b,c,d,a,x[i+13],21, 1309151649);
        a=ii(a,b,c,d,x[i+ 4], 6, -145523070);d=ii(d,a,b,c,x[i+11],10,-1120210379);c=ii(c,d,a,b,x[i+ 2],15,  718787259);
        b=ii(b,c,d,a,x[i+ 9],21, -343485551);a=ad(a,olda);b=ad(b,oldb);c=ad(c,oldc);d=ad(d,oldd);
    }
    return rh(a)+rh(b)+rh(c)+rh(d);
}

/*--------------------------------------------------------------
3.0 NAVIGATION
--------------------------------------------------------------*/

    /*------------------------------------------------------------
    |
    | 3.1 HAMBURGER FUNCTIONALITY
    |
    ------------------------------------------------------------*/

async function enableNavbar() {
    toggleButton = await waitUntilLoaded('.toggle-button');
    resourcesButton = await waitUntilLoaded('.resources-button');
    resourcesLinks = await waitUntilLoaded('.nav-resources');
    subcategoryButton = await waitUntilLoaded('.subcategory-button');
    navbarItems = await waitUntilLoaded('.navbar-items');

    if (toggleButton !== null) {
        toggleButton.addEventListener('click', () => {
            navbarItems.classList.toggle('active');
        })
    }
    
    if (resourcesButton !== null) {
        resourcesButton.addEventListener('click', () => {
            resourcesLinks.classList.toggle('active');
        })
    }
    
    if (subcategoryButton !== null) {
        subcategoryButton.addEventListener('click', (event) => {
            event.stopPropagation();
            subcategoryButton.classList.toggle('active');
        })
    }
}

enableNavbar();

/*--------------------------------------------------------------
4.0 CUSTOM CURSOR
--------------------------------------------------------------*/

    /*------------------------------------------------------------
    |
    | 4.1 DETECT DEVICE
    |
    ------------------------------------------------------------*/

let orientationLandscape = (screen.availWidth > screen.availHeight);
let isMobile = (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/iPhone/i));
let coarsePointer = window.matchMedia("(any-pointer:coarse)").matches;

window.addEventListener("touchstart", detectTouch);

function detectTouch() {  // If a touch is detected, make sure the custom cursor is disabled 
    console.log("isMobile");
    window.removeEventListener("touchstart", detectTouch);
    window.removeEventListener("mousemove", customCursorListener);
}

window.addEventListener('mousemove', detectCursor);

function detectCursor() {  // If a cursor is detected, make sure the custom cursor is enabled 
    console.log("isDesktop");
    toggleCustomCursor(true);
    window.removeEventListener("mousemove", detectCursor);
}

    /*------------------------------------------------------------
    |
    | 4.2 CURSOR
    |
    ------------------------------------------------------------*/

const customCursorListener = (event) => { updateCustomCursor(event); };

window.addEventListener('mousemove', customCursorListener);

function toggleCustomCursor(enable=true) {
    if (enable) {display = 'block'} else {display = 'none'}
    cursor.style.display = display;
    cursorInner.style.display = display;
    cursorOuter.style.display = display;
}

function toggleCursorHover(event) {
    const target = event.target;
    
    const isLinkTag = target.tagName.toLowerCase() === 'a'  || target.classList.contains('cursor-hover');
    const isHovered = cursorInner.classList.contains('hoveredCursor');
    
    // Toggle the cursor class if necessary 
    if(isLinkTag && !isHovered) {
        cursorInner.classList.add('hoveredCursor');
    } else if(!isLinkTag && isHovered) {
        cursorInner.classList.remove('hoveredCursor');
    }
}

function positionCustomCursor(event) {  // Whenever a mouse movement is detected, update the custom cursor position
    cursorInner.style.left = event.pageX + 'px';
    cursorInner.style.top = event.pageY - window.scrollY + 'px';

    cursorOuter.style.left = event.pageX + 'px';
    cursorOuter.style.top = event.pageY - window.scrollY + 'px';
}

function updateCustomCursor(event) {
    toggleCursorHover(event);
    positionCustomCursor(event);
} 
