// External Dependencies
import React, { Component } from 'react';


// Internal Dependencies
import './style.css';


class S3DM_TeamList extends Component {

  static slug = 's3dm_teamlist';

  
  render() {
    
    return (
      <div className="s3dm_teammember_container_wrapper uk-child-width-1-4@m uk-child-width-1-1" uk-grid="true">
          {this.props.content}
      </div>
    );
  }
}

export default S3DM_TeamList;
