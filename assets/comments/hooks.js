import React, {useState,useCallback} from "react";


async function jsonLdFectch(url, method='GET', data = null){
    //console.log("Data from JsonLdFetch", data)
    const params = {
        method:method,
        headers:{
            'Accept' : 'application/ld+json',
            'Content-Type' :'application/json'
        }
    }

    if (data){
        params.body = JSON.stringify(data)
    }
    const response = await fetch(url, params)
    if(response.status === 204){
        return null
    }

    const responseData = await response.json()
    if (response.ok){
        return responseData
    }
    else {
        throw responseData
    }
}

export function usePaginatedFetch(url){
    const [loading, setLoading] = useState(false)
    const [items, setItems] = useState([])
    const [count, setCount] = useState(0)
    const [next, setNext] = useState(null)

    const load = useCallback(async () => {

        setLoading(true)

        try{
        const response = await jsonLdFectch(next || url)
        setItems(items => [...items, ...response['hydra:member']])
        setCount(response['hydra:totalItems'])

            if(response['hydra:view'] && response['hydra:view']['hydra:next']){
                setNext(response['hydra:view']['hydra:next'])
            }else {
                setNext(null)
            }

        }catch (error) {
            console.error(error)
        }

        setLoading(false)

    }, [url, next])

    return {
        items,
        setItems,
        load,
        loading,
        count,
        hasMore:next!=null
    }


}

export function usefetch(url, method="POST", callback=null){
    const[errors, setErrors] = useState({})
    const[loading, setLoading] = useState(false)


    const load = useCallback(async (data = null) => {
        setLoading(true)

        console.log('Log: ', data)

        try {
            const response = await jsonLdFectch(url, method, data)
            if(callback){
                callback(response)
            }
        }catch (error){
            setErrors(error)
        }
        setLoading(false)
    }, [url, method, callback])

    return{
        load,
        errors,
        loading
    }
}