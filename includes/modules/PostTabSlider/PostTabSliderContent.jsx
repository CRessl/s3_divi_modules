// External Dependencies
import React, { Component } from 'react';


class PostTabSliderContent extends Component {


  render() {
    const postData = this.props.postData;
    
    let items;

    if(postData){
      
      items = postData.map(({categories, title, image, link, excerpt}, index) => 
        <div className="uk-grid uk-child-width-1-2@m uk-child-width-1-1 s3dm_grid_container" uk-grid="true" key={index}>
          <div className="s3dm_grid_content">
            <div className="s3dm_tab_content_post_categories uk-grid-small" uk-grid="true" dangerouslySetInnerHTML={{__html: categories}}></div>
            <div className="s3dm_tab_content_post_title"><h2>{title}</h2></div>
            <div className="s3dm_tab_content_post_excerpt uk-margin-medium-bottom">
              {excerpt}
            </div>
            <div className="s3dm_tab_content_post_link">
              <a href={link}>Zum Artikel</a>
            </div>
          </div>
          <div className="s3dm_grid_image">
            <div className="s3dm_tab_content_post_image uk-background-cover uk-background-center-center" style={{backgroundImage: `url(${image})`}}>
              <img src={image} className="uk-hidden" alt={title}/>
            </div>
          </div>
        </div>
      );
    }else{
      items = 'No Posts Found';
    }
    

    return (
      <div className="uk-switcher s3dm_tab_contents uk-margin-medium-bottom">
        {items}
      </div>
    );
  }
}

export default PostTabSliderContent;
