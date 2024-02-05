<style>
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
.position-relative {
    position: relative;
}
.container_form {
    position: relative;
    display: flex;
    justify-content: center;
}
.container_form > * {
    background-color: red;
    position: absolute;
    z-index: 1001;
    padding: 10px;
}
.close-btn {
    position: absolute;
    top: 1px;
    right: 10px;
    font-size: 20px;
    color: #000;
    text-decoration: none;
}
#followerButton, #followingButton {
    background-color: transparent; 
    border: none; 
    box-shadow: none;
    color: black;
}
#followerButton::after, #followingButton::after {
    display: none;
}
.dropdown-menu {
    max-height: 200px;
    overflow-y: auto;
    max-width: 200px;
}

.image-container {
    display: flex;
    flex-wrap: wrap;
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.button-container button {
    margin: 0 10px;
}

.image-container img {
    width: calc(33.33% - 10px);
    margin-bottom: 10px;
    box-sizing: border-box;
}

.select{
    background-color: #4f0484;
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

.container .row .col-12.col-md-3.text-center #p_profile {
    width: 200px;
    height: 200px;
    object-fit: cover;
}
</style>