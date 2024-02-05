<style>
    #p_profile{
        width: 50px;
        height: 50px;
    }
    #friend_search {
        width: 70%;
        margin: 10px;
        
    }
    #s_button {
        margin-bottom: 5px;
    }
    .alert {
        width: 70%;
    }
    .select{
        background-color: #000;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .post-container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .profile-section {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .profile-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .username {
        font-weight: bold;
    }

    .post-image {
        width: 100%;
        height: auto;
    }

    .interaction-icons {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #eee;
    }

    .icon {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .icon img {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }

    .profile-section a {
        display: flex; 
        align-items: center; 
        text-decoration: none;
        color: inherit;
    }

    .post-description{
        padding: 10px;
    }

    .collapsible-tags-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-top: 1px solid #eee;
    }

    .tags-button {
        background-color: transparent;
        border: none;
        color: #4f0484;
        cursor: pointer;
    }

    .tags-button:focus {
        outline: none;
    }

    .tags-collapse {
        display: flex;
        flex-wrap: wrap;
    }

    .tag-pill {
        margin-right: 5px;
        margin-bottom: 5px;
        padding: 5px 10px;
        background-color: #4f0484;
        color: #fff;
        border-radius: 20px;
        cursor: pointer;
    }

    .btn-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px; /* Aggiunge uno spazio tra i bottoni */
    }

    .btn-group button {
        margin-bottom: 10px; /* Spazio aggiuntivo sotto ciascun bottone, se necessario */
    }

    .alert-info a {
        text-decoration: none; 
        color: inherit;"
    }

    #post_form {
        display: none;
    }
</style>
