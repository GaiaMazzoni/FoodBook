<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </style>
    <title>Responsive Interface</title>
</head>
<style>
    button{
        background-color: #fccf00;
    }
    #top_banner{
        box-sizing: border-box;
        background-color: #4f0484;
        position: sticky;
        top: 0px;
        width: 100%;
        height: 1;
    }
    #bottom_banner{
        box-sizing: border-box;
        background-color: #4f0484;
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 5%;
    }
</style>
<body>
    <div class="top_banner"></div>
    <form method="post">
    <div id="Food Types" class="category_field">
        <button class="Appetizer" name="Appetizer">Appetizer</button>
        <button class="Cocktail" name="Cocktail">Cocktail</button>
        <button class="Dessert" name="Dessert">Dessert</button>
    </div>

    <div id="Time" class="category_field">
        <button class="15min" name="15min">15min</button>
        <button class="30min" name="30min">30min</button>
    </div>

    <div id="Diet" class="category_field">
        <button class="Gluten-free" name="Gluten-free">Gluten-free</button>
        <button class="Pescetarian" name="Pescetarian">Pescetarian</button>
    </div>

    <div id="Difficutly" class="category_field">
        <button class="Beginner" name="Beginner">Beginner</button>
        <button class="Expert" name="Expert">Expert</button>
    </div>

    <div id="Budget" class="category_field">
        <button class="$" name="$">$</button>
        <button class="$$" name="$$">$$</button>
    </div>
    </form>
    
</body>
</html>