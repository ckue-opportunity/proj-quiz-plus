<?php
        // A. Snippet for input tag
        // <input type="radio" id="answer0" name="radio" 
        //       value="<?php echo $pageData['answers'][0]['correct']; ?>">

        // B. Snippet with placeholders
        // <input type="radio" id="answer?" name="radio" value="?">

        // C. Create echo command; wrap input tag in single quotes.
        // echo '<input type="radio" id="answer?" name="radio" value="?">';

        // D. Replace placeholders with values from variables.
        // Replace ? in ' . ? . ' with the required value.
        echo '<input type="radio" id="answer' . $answerCount . '" name="radio" value="' . $answer['correct'] . '">'; 
        

        // !!! same method here with the next line !!!

        // A.
        <label for="answer0"><?php echo $pageData['answers'][0]['text']; ?></label><br>

        // B. continue with C. and D. ...
?>