// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_Cluster extends Component {

  static slug = 's3dm_cluster';

  static css(props){

    const additionalCss  = [];

    additionalCss.push([{
        selector:    '%%order_class%% .s3dm_cluster_container',
        declaration: `min-height: ${props.min_height};`,
    }]);

    return additionalCss;


  }

  render() {

    return (
        <div className="s3dm_cluster_container">
            {this.props.content}
        </div>
    );
  }

}

export default S3DM_Cluster;
