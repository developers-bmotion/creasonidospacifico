function setStorage(key, value) {
    if (value === null) {
        clearStorage(key);
        return;
    }
    localStorage.setItem(key, value);
}

function getStorage(key) {
    let value = localStorage.getItem(key);
    if (value) {
        return value;
    }
    return null;
}

function clearStorage(key) {
    localStorage.removeItem(key);
}
