/*API PIXABAY*/

const numResults = 10

//keys n andpoint
const img_key = '26908881-2da8efcfa7d053313d4470fa3'
const img_api = 'https://pixabay.com/api/'

//stampiamo immagine json per vedere che campi ha
function ImgJson(json){
    console.log(json)

    const risultati = json.hits
    const album = document.querySelector('#global-view')
    //svuoto l'intero contenitore di immagine prima di ottenere le altre ottenute dalle API
    album.innerHTML = ''

    //scorro i risultati all'interno dell'array
    for(let result of risultati){
        const imgContainer = document.createElement('div')
        imgContainer.classList.add('container')
        const img = document.createElement('img')
        img.addEventListener('click', modalFunc)
        img.src = result.largeImageURL
        imgContainer.appendChild(img)
        album.appendChild(imgContainer)
    }
}

function modalFunc(event){
    const modale = document.querySelector('#mod')
    modale.classList.remove('hidden')
    modale.classList.add('modale')
    const img = document.createElement('img')
    img.src = event.currentTarget.src; //l'immagine è il target del nostro evento
    modale.appendChild(img)
    document.body.classList.add('no-scroll')
}

function closeModal(event){
    console.log(event)
    const chiave = event.key
    if(chiave === 'Escape'){
        const modale = document.querySelector('#mod')
        const img = modale.querySelector('img')
        img.remove()
        modale.classList.remove('modale')
        modale.classList.add('hidden')
        document.body.classList.remove('no-scroll')
    }
}

function onResponse(response) {
    return response.json();
}

function sendRequest(event){
    event.preventDefault();

    const text = document.querySelector('#element').value
    //codifichiamo il testo che compare nella barra di ricerca (codifica il testo da inviare in modo accettabile all'interno dell'url)
    const encodedText = encodeURIComponent(text)
    console.log('Eseguo ricerca: ' + encodedText)
    //preparo la ricerca
    
    const image_req = img_api + '?key=' + img_key + '&q=' + encodedText + '&per_page=' + numResults
    
    console.log('URL: '+ image_req)

    fetch(image_req).then(onResponse).then(ImgJson)
}

const form = document.querySelector("#search_content")
form.addEventListener('submit', sendRequest)

window.addEventListener('keydown', closeModal)


//OAUTH 2.0

var client_id = 'de38b240910d46079cdb0ce20540eb1e'
var client_secret = 'e1fd804515644a3283d44819e9415d7e'

//All'apertura della pagina, richiediamo il token

fetch('https://accounts.spotify.com/api/token',
  {
    method: 'post',
    body: 'grant_type=client_credentials',
    headers:
    {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization': 'Basic ' + btoa(client_id + ':' + client_secret) //serve per richiedere il token dalle 2 variabili client_id e client_secret
    }
  }
).then(onResponse).then(getToken)


let token_data

function getToken(json){
  console.log(json)

  token_data = json.access_token
}

//ROMA

function oauth_Request(event){
  event.preventDefault()

  const butt = document.querySelector('#but1')

  var cityname = 'roma'
  fetch('https://api.spotify.com/v1/search?q=' + cityname + '&type=album',
  {
    headers: 
    {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization': 'Bearer ' + token_data  
    }
  }
  ).then(onResponse).then(oauthJson)

}

const buclick = document.querySelector('#cityb')
buclick.addEventListener('click', oauth_Request)

function oauthJson(json){
  const library = document.querySelector('#city-api')
  library.innerHTML = ''
  const results = json.albums.items
  let num_res = results.length
  if(num_res>5) num_res=5
  for(let i=0;i<num_res; i++){
    const track_data = results[i]
    const title = track_data.name
    const selected_image = track_data.images[0].url
    const album = document.createElement('div')
    album.classList.add('album')
    const img = document.createElement('img')
    img.src = selected_image
    const caption = document.createElement('span')
    caption.textContent = title
    album.appendChild(img)
    album.appendChild(caption)
    library.appendChild(album)
  }
}


/*KATOWICE*/

function kat_Request(event){
  event.preventDefault()

  const butt = document.querySelector('#but2')

  var cityname = 'katowice'
  fetch('https://api.spotify.com/v1/search?q=' + cityname + '&type=album',
  {
    headers: 
    {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization': 'Bearer ' + token_data  
    }
  }
  ).then(onResponse).then(katJson)

}

const katclick = document.querySelector('#katb')
katclick.addEventListener('click', kat_Request)

function katJson(json){
  const library = document.querySelector('#kat-api')
  library.innerHTML = ''
  const results = json.albums.items
  let num_res = results.length
  if(num_res>5) num_res=5
  for(let i=0;i<num_res; i++){
    const track_data = results[i]
    const title = track_data.name
    const selected_image = track_data.images[0].url
    const album = document.createElement('div')
    album.classList.add('album')
    const img = document.createElement('img')
    img.src = selected_image
    const caption = document.createElement('span')
    caption.textContent = title
    album.appendChild(img)
    album.appendChild(caption)
    library.appendChild(album)
  }
}

/*BALI*/

function bali_Request(event){
  event.preventDefault()

  const butt = document.querySelector('#but3')

  var cityname = 'bali'
  fetch('https://api.spotify.com/v1/search?q=' + cityname + '&type=album',
  {
    headers: 
    {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization': 'Bearer ' + token_data  
    }
  }
  ).then(onResponse).then(baliJson)

}

const baliclick = document.querySelector('#balib')
baliclick.addEventListener('click', bali_Request)

function baliJson(json){
  const library = document.querySelector('#bali-api')
  library.innerHTML = ''
  const results = json.albums.items
  let num_res = results.length
  if(num_res>5) num_res=5
  for(let i=0;i<num_res; i++){
    const track_data = results[i]
    const title = track_data.name
    const selected_image = track_data.images[0].url
    const album = document.createElement('div')
    album.classList.add('album')
    const img = document.createElement('img')
    img.src = selected_image
    const caption = document.createElement('span')
    caption.textContent = title
    album.appendChild(img)
    album.appendChild(caption)
    library.appendChild(album)
  }
}


/*BERLINO*/

function berli_Request(event){
  event.preventDefault()

  const butt = document.querySelector('#but4')

  var cityname = 'berlino'
  fetch('https://api.spotify.com/v1/search?q=' + cityname + '&type=album',
  {
    headers: 
    {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization': 'Bearer ' + token_data  
    }
  }
  ).then(onResponse).then(berliJson)

}

const berliclick = document.querySelector('#berlib')
berliclick.addEventListener('click', berli_Request)

function berliJson(json){
  const library = document.querySelector('#berli-api')
  library.innerHTML = ''
  const results = json.albums.items
  let num_res = results.length
  if(num_res>5) num_res=5
  for(let i=0;i<num_res; i++){
    const track_data = results[i]
    const title = track_data.name
    const selected_image = track_data.images[0].url
    const album = document.createElement('div')
    album.classList.add('album')
    const img = document.createElement('img')
    img.src = selected_image
    const caption = document.createElement('span')
    caption.textContent = title
    album.appendChild(img)
    album.appendChild(caption)
    library.appendChild(album)
  }
}

/*CHICAGO*/

function chic_Request(event){
  event.preventDefault()

  const butt = document.querySelector('#but5')

  var cityname = 'chicago'
  fetch('https://api.spotify.com/v1/search?q=' + cityname + '&type=album',
  {
    headers: 
    {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization': 'Bearer ' + token_data  
    }
  }
  ).then(onResponse).then(chicJson)

}

const chicclick = document.querySelector('#chicb')
chicclick.addEventListener('click', chic_Request)

function chicJson(json){
  const library = document.querySelector('#chic-api')
  library.innerHTML = ''
  const results = json.albums.items
  let num_res = results.length
  if(num_res>5) num_res=5
  for(let i=0;i<num_res; i++){
    const track_data = results[i]
    const title = track_data.name
    const selected_image = track_data.images[0].url
    const album = document.createElement('div')
    album.classList.add('album')
    const img = document.createElement('img')
    img.src = selected_image
    const caption = document.createElement('span')
    caption.textContent = title
    album.appendChild(img)
    album.appendChild(caption)
    library.appendChild(album)
  }
}


/*LIKES*/

function prendiLike(event){
    const butt = event.currentTarget;
    console.log(butt);
  
    const tit = butt.querySelector("h1").textContent;
    console.log(tit)
    const descri = butt.querySelector("p").textContent;
    const titolin = butt.querySelector("strong").textContent;
    const im = butt.querySelector("img").src;
    console.log(im);
  
    fetch("update_likes.php?&titolo="+tit+"&descrizione="+descri+"&titolino="+titolin+"&img="+im);
  
    const ht = butt.querySelector("#cf");
    ht.classList.remove("like");
    ht.classList.add("liked");

    event.currentTarget.removeEventListener("click", prendiLike);
    event.currentTarget.addEventListener("click", removeLike);  
  }
  
  function removeLike(event){
    const butt = event.currentTarget;
    console.log(butt);
  
    const ht = butt.querySelector("#cf");
    ht.classList.remove("liked");
    ht.classList.add("like");
  
    event.currentTarget.removeEventListener("click", removeLike);
    event.currentTarget.addEventListener("click", prendiLike); 
}
  

  const plike = document.querySelectorAll(".post_grid");
  for(let i of plike){
    console.log("prova"+i);
    i.addEventListener('click', prendiLike);
  }
  
  
  