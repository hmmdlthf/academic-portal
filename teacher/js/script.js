function toggleFloatingMenu() {
    document.getElementById('floatingMenu').classList.toggle('hidden');
    document.getElementById('menuWrapper').classList.toggle('hidden');
    document.getElementById('menuBtn').classList.toggle('active');
}

document.querySelectorAll('.menu__link').forEach((x) => {
    x.addEventListener('click', () => {
        link = x.id.slice(6);
        path = `/teacher/${link}/${link}.php`
        document.location = `${path}?link=${link}`;
    })
})

let params = new URLSearchParams(document.location.search);
let link = params.get("link");
document.getElementById(`link__${link}`).classList.add('active');
document.querySelector('.header .header__left .title').innerHTML = link;
document.querySelector('title').innerHTML = `Online Acedemy | ${link}`;