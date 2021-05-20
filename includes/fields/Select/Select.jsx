// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class Select extends Component {

  constructor(props, context) { 
    super(props, context);

    this.state = {
      clicked: false
    };

  }
  
  static slug = 's3dm_select';

  _clickHandler = (event) => {
    
    this.setState(({ clicked }) => ({ clicked: !clicked }));

  }

  render() {
   
    const post_type = this.props.fieldDefinition.post_type;


    return(
      <div>
        <input 
          id={`s3dm_select_button-${this.props.name}`}
          className="s3dm-select"
          value={this.props.value}
          type='text'
          onClick={this._clickHandler} 
          placeholder={"Click to select "+post_type}
          
        />
        {this.state.clicked ? "Show me" : null}
      </div>
    );
  }
}

export default Select;
