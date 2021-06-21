import React from 'react';
import ReactDOM from 'react-dom';
import Index from './Index';
function Example() {
    return (
        <div className="container">
           <Index/>
        </div>
    );
}

export default Example;

if (document.getElementById('app')) {
    ReactDOM.render(<Example />, document.getElementById('app'));
}
