import {render, unmountComponentAtNode} from "react-dom";
import React, {useCallback, useEffect, useRef} from "react";
import {usefetch, usePaginatedFetch} from "./hooks";
import {Icon} from "../components/icon";
import {Field} from "../components/form";

const dateFormat = {
    dateStyle : 'medium',
    timeStyle:'short'
}

function Comments(user){

    const {items:comments,setItems:setComments, load, loading,count, hasMore} = usePaginatedFetch('/api/comments')

    const addComment = useCallback(comment=>{
        setComments(comments => [comment, ...comments])
    }, [])


    useEffect(() => {
        load()
    }, [])


    return <div className="container">
        <Title count={count}/>
        {user && <CommentForm onComment={addComment} /> }
        <div className="chat-history">
            <ul className="m-b-0">
                {comments.map(c => < Comment key={c.id} comment={c} canEdit={c.id===user} />)}
            </ul>
        </div>

        {hasMore && <button disabled={loading} className="btn btn-primary" onClick={load}>charger plus de commentaires</button>}
    </div>
}

const Comment = React.memo(({comment}) => {
    const date = new Date(comment.createdAt)

    return <li className="clearfix">
            <div className="message-data text-right">
                <span className="message-data-time">{date.toLocaleString(undefined, dateFormat)}</span>
            </div>
            <div className="message other-message float-right"> {comment.comment}
            </div>
        </li>

})

const CommentForm = React.memo(({onComment}) => {

    const ref = useRef(null)
    const onSuccess = useCallback(comment=> {
        onComment(comment)
        ref.current.value = ''
    }, [ref, onComment])


    const {load, errors, loading} = usefetch('/api/comments', 'POST', onSuccess)

    const onSubmit = useCallback(e=>{
        e.preventDefault()
        // console.log('Log: ',ref.current.value)


        load({ 'comment': ref.current.value })
    }, [load, ref])

    console.log(ref)

    return <form onSubmit={onSubmit}>
        <fieldset>
            <legend> <Icon icon="comment"></Icon> Laisser un commentaire</legend>
        </fieldset>
        <Field name="content"
               help="Les commentaires non conformes a notre code de conduite seront modérés."
               ref={ref}
               required
               minLength={10}
               error={errors['content']}> Votre commentaire </Field>
        <div className="form-group">
            <button className="btn btn-primary" disabled={loading}>
                <Icon icon="paper-plane"/> Envoyer
            </button>
        </div>
    </form>
})

function Title({count}){
    return <h3>
        <Icon icon="comments"/>
        {count} Commentaire{count> 1 ? 's' : ''}
    </h3>
}

class CommentElement extends HTMLElement{

    connectedCallback(){

        const user = parseInt(this.dataset.user, 10) || null


        render(<Comments user={user}/>, this)
    }

    disconnectedCallback(){
        unmountComponentAtNode(this)
    }

}

customElements.define('post-comments',CommentElement);