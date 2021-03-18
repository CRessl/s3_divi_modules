// External Dependencies
import React, { Component } from 'react';


class PostTabSliderNav extends Component {

  

  render() {
    const postData = this.props.postData;
    let items;

    if(postData){

      items = postData.map(({categories, title}, index) => 
        <div className="tab-content" key={index}>
          <div className="uk-padding-small uk-padding-remove-horizontal">
              <div className="s3dm_tab_nav_category_list uk-margin-bottom uk-grid-small" uk-grid="true" dangerouslySetInnerHTML={{__html: categories}}></div>
              <div className="s3dm_tab_nav_post_title">{title}</div>
          </div>
        </div>
      );
    }else{
      items = 'No Posts Found';
    }

    return (
      <div className="s3dm_switcher s3dm_tab_navigation uk-grid uk-child-width-1-4">
        {items}
      </div>
    );
  }
}

export default PostTabSliderNav;
