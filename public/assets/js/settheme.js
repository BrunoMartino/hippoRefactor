const timeSetTema = setInterval(() => {
    let tema = localStorage.getItem('tema') ?? 'light'
    document.querySelector('html').dataset.bsTheme = tema
}, 10);

setTimeout(() => {
    clearInterval(timeSetTema)
}, 3000);