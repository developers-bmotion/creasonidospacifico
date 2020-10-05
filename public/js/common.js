
let urls = {};
let texto = {};

const getUrl = function (name){
    return urls[name];
}

const setUrl = function (name,value){
    if(urls[name]){
        console.error("El nombre de la url ("+name+") ya existe");
    }else{
        urls[name] = value;
    }
}

const getText = function (name){
    return texto[name];
}

const setText = function (name, value){
    if(texto[name]){
        console.error("El nombre del texto ("+name+") ya existe");
    }else{
        texto[name] = value;
    }
}

const showUrls = function (){
    console.log(urls);
}

const showText = function (){
    console.log(texto);
}

