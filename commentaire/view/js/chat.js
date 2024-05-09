function askQuestion() {
    var userInput = document.getElementById("user-input").value;
    var chatDiv = document.getElementById("chat");

    // Afficher la question de l'utilisateur dans la conversation
    chatDiv.innerHTML += "<p><strong>Utilisateur :</strong> " + userInput + "</p>";

    // Envoyer la question à PHP pour obtenir la réponse du chatbot
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "bot.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Afficher la réponse du chatbot dans la conversation
            chatDiv.innerHTML += "<p><strong>ChatBot :</strong> " + xhr.responseText + "</p>";
        }
    };
    xhr.send("question=" + userInput);
}
