// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

class S3DM_PostSelect extends Component {

  static slug = 's3dm_post_select';

  constructor(props) {
    super(props);
    this.state = {
      error: null,
      isLoaded: false,
      postTypes: [],
      posts: []
    };
  }

  /**
   * Handle input value change.
   *
   * @param {object} event
   */
  _onChange = (event) => {
    this.props._onChange(this.props.name, event.target.value);
  }

  _getPostTypeOptions(){

    

  }

  render() {
    return(
      <div>
        <select
            id={`s3dm-input-${this.props.name}`}
            name={this.props.name}
            value={this.props.value}
            type='select'
            className='s3dm-post-select-select'
            onChange={this._onChange}
        >
          <option value="0">Some Option Test </option>
        </select>
        <div className="s3dm-post-select-testdiv">
          <input type="text" name="search" placeholder="Search..."/>
        </div>
      </div>
    );
  }
}

export default S3DM_PostSelect;
