// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_WorkGroups extends Component {

  static slug = 's3dm_work_groups';

  renderSingleLayout(data){
    return(
      <div className="s3dm_workgroups_item uk-grid-match" uk-grid="true">
  
              <div className="uk-width-expand uk-flex-middle uk-flex uk-padding-remove-top uk-padding-remove-bottom uk-padding">
                  <div>
                      <h2>{data.title}</h2>
                      <p>{data.content}</p>
                  </div>
              </div>
              <div className="s3dm_workgroups_slider_item_contact uk-width-auto section-workshopsMulti-bubble" style={{width: '350px', height: '350px'}}>
                  <div>
                      <h3>Kontakt</h3>
                     
                  </div>
              </div>
  
        </div>
      );
  
  }

  renderSliderLaoyut(data){
    
  }

  render() {
    
    const data = this.props.__workgroupData;
    let items;

    if(data.length > 1){
      items = this.renderSingleLayout(data);
    }else{
      items = this.renderSliderLayout(data);
    }

    return (
      <div>
        {items}
      </div>
    );
  }
}

export default S3DM_WorkGroups;
