// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_ClusterItem extends Component {

  static slug = 's3dm_cluster_item';

  static css(props){

    const additionalCss  = [];

    additionalCss.push([{
        selector:    '%%order_class%%.s3dm_cluster_item',
        declaration: `height: 130px; position: absolute !important; left: ${props.position_left}; top: ${props.position_top};`,
    }]);

    return additionalCss;

  }

  render() {
   
    return (
        <div className={"s3dm_cluster_item_content uk-text-center " + this.props.current_category}>
            <div class="s3dm_cluster_item_image">
                <img src={this.props.icon} alt={this.props.title} />
            </div>
            <div class="s3dm_cluster_item_title">
                <p>{this.props.title}</p>
            </div>
        </div>
    );
  }

}

export default S3DM_ClusterItem;
