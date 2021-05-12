// External Dependencies
import React, { Component } from 'react';


class PostListGrid extends Component {

  renderImageTop(image){
    if(this.props.settings.show_image === 'on'){
      return (
        <div className="s3dm_post_list_image" dangerouslySetInnerHTML={{__html: image}}></div>
      )
    }
  }

  renderDate(date){

    if(this.props.settings.show_date === 'on' && this.props.settings.show_meta === 'on'){
      return (
        <div className="s3dm_post_list_date">
              <span>
              {date}  
              </span>
        </div>
      )
    }
    
  }

  renderTags(tags){

    if(this.props.settings.show_tags === 'on' && this.props.settings.show_meta === 'on'){
      return (
        <div className="s3dm_post_list_tags" dangerouslySetInnerHTML={{__html: tags}}></div>
      )
    }
    
  }

  renderExcerpt(excerpt){
    if(this.props.settings.show_excerpt === 'on'){
      return(
        <div className="s3dm_post_list_excerpt">
              <p>
                  {excerpt}
              </p>
        </div>
      )
    }
  }

  render() {
    const postData = this.props.posts;
    let postListItems;

    postListItems = postData.map(({title, image, tags, excerpt, date, link}, index) => {
        
      return (
        <div key={index}>
          <div className="uk-card-default">
            <div class="s3dm_post_list_grid_image">
              {this.renderImageTop(image)}
            </div>
            <div className="uk-card-body">  
              <a href={link} className="uk-position-cover"><span className="uk-hidden">{title}</span></a>

              {this.renderDate(date)}
              
              <div className="s3dm_post_list_title">
                  <h3>
                      {title}
                  </h3>
              </div>
      
              {this.renderTags(tags)}

              {this.renderExcerpt(excerpt)}

            </div>
          </div>
          

        </div>
      );

  });

  return(
    <div className={"s3dm_post_list_grid uk-grid uk-grid-match uk-child-width-1-1 uk-child-width-1-"+this.props.settings.columns+"@m"} uk-grid="">
      {postListItems}
    </div>
  )
    
  }
}

export default PostListGrid;
