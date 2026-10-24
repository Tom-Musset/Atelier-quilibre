const menuToggle = document.querySelector('.menu-toggle');
const menu = document.querySelector('#primary-menu');

if ( menuToggle && menu ) {
    //ouvrir menu burger
    menuToggle.addEventListener('click', () => {
        
        const isExpanded =
            menuToggle.getAttribute('aria-expanded') === 'true';

        const shouldOpen = !isExpanded;

        menuToggle.setAttribute('aria-expanded', String(shouldOpen));
        menu.classList.toggle('is-open', shouldOpen);
        document.body.classList.toggle('menu-open', shouldOpen);

        if(shouldOpen){
            menu.querySelector('a[href]')?.focus();
        }
    });

    //fermer le menu quand on clique un lien
    const menuLinks = menu.querySelectorAll('a');
    menuLinks.forEach((link) => {
        link.addEventListener('click', () => {
            menuToggle.setAttribute('aria-expanded', 'false');
            menu.classList.remove('is-open');
            document.body.classList.remove('menu-open');
        })
    });

    //sortir du menu avec ECHAP
    document.addEventListener('keydown', (event) => {
        if(
            event.key === 'Escape' &&
            menu.classList.contains('is-open')
        ){
            menu.classList.remove('is-open');
            document.body.classList.remove('menu-open');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.focus();
        }
    })

    //se deplacer dans le menu avec TAB
    menu.addEventListener('keydown', (event) => {
        if(event.key !== 'Tab' || !menu.classList.contains('is-open')){
                return;
        }

        const focusableElements = menu.querySelectorAll('a[href]');
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1 ];

        if ( event.shiftKey && document.activeElement === firstElement ) {
            event.preventDefault();
            lastElement.focus();
} else if (  !event.shiftKey && document.activeElement === lastElement) {
            event.preventDefault();
            firstElement.focus();
        }
    });
}