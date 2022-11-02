<style>
    li {
        list-style: none;
    }
    a {
        text-decoration: none;
        color: black;
    }

    .footer {
        position: sticky;
        top: 100vh;
        margin: auto;
        padding: 10px;
        width: 100%;
        background-color: rgb(248,249,250);
        color: black;
    }

    .location-icon {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .ebook-img {
        width: 64px;
        height: 64px;
    }

    @media only screen and (max-width: 995px) {
        .location-icon {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    }

    @media only screen and (max-width: 775px) {
        #ebook-logo {
            display: none;
        }
    }

</style>