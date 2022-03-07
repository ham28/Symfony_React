import {render, unmountComponentAtNode} from "react-dom";
import React from "react";
import {usePaginatedFetch} from "./hooks";

function Comments(){
    const {items:comments, load, loading} = usePaginatedFetch('/api/coments')


    return <div>
        {loading && 'Chargement...'}
        {JSON.stringify(comments)}

        <button onClick={load}>charger les commentaires</button>
    </div>
}


class CommentElement extends HTMLElement{

    connectedCallback(){
        render(<Comments/>, this)
    }

    disconnectedCallback(){
        unmountComponentAtNode(this)
    }

}

customElements.define('post-comments',CommentElement);