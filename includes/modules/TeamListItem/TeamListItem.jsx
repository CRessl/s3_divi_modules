// External Dependencies
import React, { Component } from 'react';


// Internal Dependencies
import './style.css';


class S3DM_TeamListItem extends Component {

  static slug = 's3dm_teamlist_item';

  
  render() {
    const content = this.props.__teamMemberData;
    
    if(!content){
       return (
           <div>
               No Teammember found
           </div>
       )
    }else{
        return (
        <div className="s3dm_teamlist_item_content_wrapper uk-inline">
            <img src={content.attachment} width="480" height="480" alt={content.name}/>
            <div className="uk-overlay-primary uk-position-cover"></div>
            <div className="uk-overlay uk-position-bottom uk-padding-small">
                <h4>
                    {content.name}
                </h4>
                <p>
                    <a href={"mailto:"+content.email}>{content.email}</a>
                </p>
            </div>
        </div>
        );
    }

    
  }
}

export default S3DM_TeamListItem;
