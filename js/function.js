function XML_Login()
{
    // Recupero i dati dal modulo HTML
    var u_id = document.modulo.u_id.value;
    var pass = document.modulo.pass.value;

    // Imposto un'espressione regolare per verificare che
    // i caratteri inseriti nei campi UserID e Password
    // siano alfanumerici, in modo da non dar fastidio all'XML
    var re = /^[a-z0-9]/;

    // Verifico che i campi siano valorizzati (correttamente)
    if (re.test(u_id) == false || re.test(pass) == false)
    {
        alert("Inserire le credenziali di accesso!");
    }
    else
    {
        // Una volta soddisfatte le condizioni...

        // Apro un oggetto XMLDOM
        var login = new ActiveXObject("Microsoft.XMLDOM");

        // Carico il file XML
        login.async = false;
        login.load("../login.xml");

        // Recupero i nodi dal file XML
        var id = login.getElementsByTagName("utente/id");
        var password = login.getElementsByTagName("utente/password");

        // Creo un indice per individuare il nodo relativo
        // all'utente che sta effettuando il login
        var indice = u_id - 1;

        // Verifico che l'utente esista e gli concedo o meno l'accesso
        if (id[indice].text == u_id && password[indice].text == pass)
        {
            alert("Benvenuto!");
        }
        else
        {
            alert("Accesso negato!");
        }
    }
}