<style>
    ul, li {
        list-style:none;
    }

    .buttons .btn {
        margin: 0 10px;
    }
    .btn a {
        color: black;
    }
    .btn a:hover {
        color: black;
    }
    .btnToCart {
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1.5px;
    }

    /* search by categroy */
    .search-by-category {
        margin: 50px 0;
    }

    /* book list */
    .list-element .livro {
        margin: 20px 0;
    }

    .title__buttons, .description
    {
        margin-left: 20px;
    }

    .book-image .book-png {
        max-width: 256px;
    }
    #bookAmount {
        border: 1px solid black;
    }
    .description p {
        font-size: 16px;
    }

    @media only screen and (max-width: 778px) {
        .livro {
            display: flex !important;
            flex-direction: column !important;
        }
        .title__buttons {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
        }
        .title__buttons .book-title h3 {
            font-size: 1.15rem !important;
        }
    }
</style>