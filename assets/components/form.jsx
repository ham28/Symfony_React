import {Icon} from "./icon";
import React from "react";

const className = (...arr) => arr.filter(Boolean).join('')

export const Field = React.forwardRef(({name, help, children, error, onChange,
                                       required, minLength}, ref) => {
    if(error){
        help = error
    }

    return <div className={className('form-group', error && 'has-error')}>
        <label htmlFor={name} className="control-label"> {children} </label>
        <textarea ref={ref}  className="form-control"
                  name={name} id={name}
                  required={required}
                  minLength={minLength}
                  onChange={onChange}/>
        {help && <div className="help-block"> {help} </div>}

    </div>
})