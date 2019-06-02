

/////////////////////////////////////////////////////////
////  Kode er oprindeligt lavet af - Yaphi - @yaphi1 ////
//// Sakset fra https://codepen.io/yaphi1/pen/NpZvJp ////
////                                                 ////
//// Vi har opdelt koden så spørgsmål og svar (JSON) ////
////    sendes med som et parameter når vi kalder    ////
////           funktionen 'generateQuiz()'           ////
////                                                 ////
////  Derudover har vi modificeret måden resultatet  ////
//// bliver udskrevet på og tilføjet vores egen CSS  ////
/////////////////////////////////////////////////////////

//Funktionen indeholdende 4 parametre, som vi kalder på siden hvor det hele skal vises
function generateQuiz(questions, quizContainer, resultsContainer, submitButton) {
    //Funktion til at generere spørgsmål og svarmulighder inkl. det HTML det kræver
    function showQuestions(questions, quizContainer) {
        //Vi skal bruge et par variabler, til at gemme vores data i. En med et tomt array, -
        //til det samlede "output" () der skal sættes ind i HTML'en og en til svarene.  
        var output = [];
        var answers;
        //For hvert spørsmål skal vi bruge et tomt array til svarmulighederne
        for (var i = 0; i < questions.length; i++) {
            answers = [];
            //For hver af svarmulighederne opretter vi et <label> tag indeholdende -
            //et <input> tag af typen radio button og svarmulighed med tilhørende bogstav
            for (letter in questions[i].answers) {
                answers.push(
                    '<label>'
                    + '<input type="radio" name="question' + i + '" value="' + letter + '">'
                    + letter + ': '
                    + questions[i].answers[letter]
                    + '</label>'
                );
            }
            //Så sætter vi hvert spørgmål og dettes svarmuligheder ind i hver sin <div>
            output.push(
                '<div class="question">' + questions[i].question + '</div>'
                + '<div class="answers">' + answers.join('') + '</div>'
            );
        }
        //Til sidst samler vi alle spørgsmål og deres svarmuligheder i en HTML string -
        //og udskriver dem på Wordpress siden, hvorfra vi kaldte fuktionen "generateQuiz()"
        quizContainer.innerHTML = output.join('');
    }
    // Funktion til at genererer resultatet
    function showResults(questions, quizContainer, resultsContainer) {
        //Først indhenter vi alle svarmulighederne fra vores HTML streng
        var answerContainers = quizContainer.querySelectorAll('.answers');
        //Så opretter vi to variabler. En tom variabel til brugerens svar og en til at -
        //holde styr på antalet af korrekte svar (korrekte svar et sat til 0 for nuværende)
        var userAnswer = '';
        var numCorrect = 0;
        //For hvert spørgsmål, placerer vi brugerens svar i variabelen vi netop har oprettet til det formålet
        for (var i = 0; i < questions.length; i++) {
            userAnswer = (answerContainers[i].querySelector('input[name=question' + i + ']:checked') || {}).value;
            //Så undersøger vi hvor mange svar der er korrekte, ved at sammenholde brugerens svar -
            //med det korrekte svar, og tælle dem sammen
            if (userAnswer === questions[i].correctAnswer) {
                numCorrect++;
                //Hvis svaret på et givent spørgsmål er korrekt, ændre vi farven på svarmulighederne til grøn
                answerContainers[i].style.color = 'green';
            }
            //Hvis svaret på et givent spørgsmål ikke er udfyldt eller er forkert, ændre vi farven på svarmulighederne til grøn
            else {
                // color the answers red
                answerContainers[i].style.color = 'red';
            }
        }
        //Vi har modificeret denne del af koden med udgangspunkt i den oprindlige løsning -
        //så resultatet skrives ud med forskellig tekst, alt efter hvor mange rigtige svar der er
        //
        //Resultatet skrives ud i <div> der har den klasse der er sendt med som parameter da funktionen 'generateQuiz()' blev kaldt
        if (numCorrect == questions.length) {
            resultsContainer.innerHTML = '<strong>Flot svaret!</stron> – Du fik ' + numCorrect + ' ud af ' + questions.length + ' svar rigtig';
        } else if (numCorrect > 0 && numCorrect <= questions.length - 1) {
            resultsContainer.innerHTML = '<strong>Ikke dårligt!</stron> – Du fik ' + numCorrect + ' ud af ' + questions.length + ' svar rigtig';
        } else if (numCorrect == 0) {
            resultsContainer.innerHTML = '<strong>Se evt. øvelsen igennem igen!</stron> – Du fik ' + numCorrect + ' ud af ' + questions.length + ' svar rigtig';
        }
    }
    //Spørgsmål og svarmuligheder vises med det samme, når funktionen 'generateQuiz()' kaldes
    showQuestions(questions, quizContainer);
    //når der klikkes på submit, vises resultatet og farven på spørgsmålne ændres alt efter om der er korrekte eller ej
    submitButton.onclick = function () {
        showResults(questions, quizContainer, resultsContainer);
    };
}
