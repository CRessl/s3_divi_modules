// External Dependencies
import React, { Component } from 'react';


class PostListGrid extends Component {

  renderImageTop(image){
    if(this.props.settings.show_image === 'on' && this.props.settings.is_product_list === 'off'){
      return (
        <div className="s3dm_post_list_grid_image uk-position-relative" dangerouslySetInnerHTML={{__html: image}}></div>
      )
    }

  }

  renderTitle(title){
      return (
        <div className="s3dm_post_list_title">
          <h2>{title}</h2>
        </div> 
      );

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

  renderExcerpt(excerpt, link){
    if(this.props.settings.show_excerpt === 'on'){
      return(
        <div className="s3dm_post_list_excerpt uk-margin-medium-bottom">
              <p>
                  {excerpt}
              </p>
              <p className="uk-margin-remove"><a className="uk-text-uppercase" href={link}>Mehr...</a></p>
        </div>
      )
    }
  }



  

  render() {
    const postData = this.props.posts;

    let postListItems;
    let containerClass = "s3dm_post_list_grid_container";
   
    if(this.props.settings.is_product_list === 'on'){
      containerClass = "s3dm_post_list_grid_container s3dm_post_list_product_container";
    }

    postListItems = postData.map(({title, image, tags, excerpt, link, date}, index) => {

      return (
        <div className={containerClass} key={index}>
          <div className="uk-card-default">
            {this.renderImageTop(image)}

            <div className="uk-card-body uk-position-relative">  
              <a href={link} className="uk-position-cover"><span className="uk-hidden">{title}</span></a>
              {this.renderDate(date)}
              {this.renderTitle(title)}
              {this.renderTags(tags)}
              {this.renderExcerpt(excerpt, link)}
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
