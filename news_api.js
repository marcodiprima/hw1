function clickNews(event){
    event.preventDefault();

    const text = document.querySelector("#testo");
    const encodedText = encodeURIComponent(text.value);
    console.log('Eseguo ricerca: ' + encodedText)

    fetch("news_api.php?q="+encodedText+"&from=2022-04-30&sortBy=publishedAt&apiKey=f88266878c504bce975444f86ead05f2").then(onResponse).then(jsonNews);
}
function onResponse(response) {
    console.log(response);
    return response.json();
}

function jsonNews(json){
    console.log('json' + json);
    const risultati = json.articles;
    const libreria = document.querySelector('#contenitore')
    libreria.innerHTML = '';

    let num_res = risultati.length
    if(num_res>10) num_res=10
    for(let i=0;i<num_res;i++){
        const articoli =risultati[i];
        const contenitore = document.createElement('div');
        const autore = articoli.author;
        const titolo = articoli.title;
        const log = articoli.content;
        const selected_img = articoli.urlToImage;

        contenitore.classList.add('visualizza');

        const author1 = document.createElement('h5');
        author1.textContent = autore;
        const argomento = document.createElement('h1');
        argomento.textContent = titolo;
        const descrizione = document.createElement('p');
        descrizione.textContent = log;
        const img = document.createElement('img');
        img.src = selected_img;
  
        contenitore.appendChild(img);
        contenitore.appendChild(argomento);
        contenitore.appendChild(author1);
        contenitore.appendChild(descrizione);
        libreria.appendChild(contenitore);
    }

}

const form = document.querySelector("#cerca_news");
form.addEventListener('submit', clickNews);