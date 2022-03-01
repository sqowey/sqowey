// Language snippets
var lang_snippets_en = {
    "soon": "Coming soon...",
    "paragraph_one": "Sqowey is a Chat-Service, that is focused on privacy. ",
    "paragraph_two": "Sqowey is fully open-source and can be found on <a href='https://github.com/sqowey/' target='_blank'>GitHub</a>.",
    "footer": "Made with ❤️ by <a href='https://github.com/cuzimbisonratte' target='_blank'>CuzImBisonratte</a>"
};
var lang_snippets_de = {
    "soon": "Kommt bald...",
    "paragraph_one": "Sqowey ist ein Chat-Service, der auf Privatsphäre ausgelegt ist. ",
    "paragraph_two": "Sqowey ist vollständig Open-Source und kann auf  <a href='https://github.com/sqowey/' target='_blank'>GitHub</a> gefunden werden.",
    "footer": "Erstellt mit ❤️ von <a href='https://github.com/cuzimbisonratte' target='_blank'>CuzImBisonratte</a>"
};

// Language elements
var soon = document.getElementById("soon");
var paragraph_one = document.getElementById("paragraph_one");
var paragraph_two = document.getElementById("paragraph_two");
var footer = document.getElementById("footer");


// Function to change the language
function changeLanguage(lang) {
    switch (lang) {
        case "de":

            // Change the language
            soon.innerHTML = lang_snippets_de.soon;
            paragraph_one.innerHTML = lang_snippets_de.paragraph_one;
            paragraph_two.innerHTML = lang_snippets_de.paragraph_two;
            footer.innerHTML = lang_snippets_de.footer;

            // Break out of the switch
            break;

        case "en":

            // Change the language
            soon.innerHTML = lang_snippets_en.soon;
            paragraph_one.innerHTML = lang_snippets_en.paragraph_one;
            paragraph_two.innerHTML = lang_snippets_en.paragraph_two;
            footer.innerHTML = lang_snippets_en.footer;

            // Break out of the switch
            break;
    }
}