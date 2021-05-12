// External Dependencies
import React, { Component } from 'react';


class PostListDefault extends Component {

  renderImageTop(image){
    if(this.props.settings.image_position === 'top' && this.props.settings.show_image === 'on'){
      return (
        <div className="s3dm_post_list_image" dangerouslySetInnerHTML={{__html: image}}></div>
      )
    }
  }

  renderImageBetween(image){
    if(this.props.settings.image_position === 'between' && this.props.settings.show_image === 'on'){
      return (
        <div className="s3dm_post_list_image" dangerouslySetInnerHTML={{__html: image}}></div>
      )
    }
  }

  renderImageBottom(image){
    if(this.props.settings.image_position === 'bottom' && this.props.settings.show_image === 'on'){
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
        <li className="uk-position-relative" key={index}>
      
          <a href={link} className="uk-position-cover"><span className="uk-hidden">{title}</span></a>
          
          {this.renderImageTop(image)}
          
          {this.renderDate(date)}
          
          <div className="s3dm_post_list_title">
              <h3>
                  {title}
              </h3>
          </div>
  
          {this.renderTags(tags)}

          {this.renderImageBetween(image)}

          {this.renderExcerpt(excerpt)}

          {this.renderImageBottom(image)}
            

        </li>
      );

  });

  return(
    <ul className="uk-list" style={{'listStyleType':'none'}}>
      {postListItems}
    </ul>
  )
    
  }
}

export default PostListDefault;
