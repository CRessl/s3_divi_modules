// External Dependencies
import React, { Component } from 'react';
import PostListDefault from './template/PostListDefault';
import PostListGrid from './template/PostListGrid';

// Internal Dependencies
import './style.css';


class S3DM_PostList extends Component {

  static slug = 's3dm_post_list';
  
  renderLayout(layout, posts){

    if(!posts){
      return "Content couldn't be loaded";
    }

    if(layout === 'first_post_left'){

      return this.renderFirstPostLeft(posts);
    
    }

    if(layout === 'grid'){

      return this.renderGridLayout(posts);

    }

    if(layout === 'default'){

      return this.renderListLayout(posts);

    }

  }

  renderGridLayout(posts){

    const settings = this.props;

    return(
      <PostListGrid posts={posts} settings={settings}></PostListGrid>
    )

  }


  renderListLayout(posts){

    const settings = this.props;

    return(
      <PostListDefault posts={posts} settings={settings}></PostListDefault>
    )

  }

  renderFirstPostLeft(posts){
    let firstPost;
    let lastPosts;

    if(posts){

      firstPost = posts.map(({title, image, tags, excerpt, date, link}, index) => {
        
        if(index === 0){
          return (
            <div className="uk-position-relative" key={index}>
          
                <a href={link} className="uk-position-cover"><span className="uk-hidden">{title}</span></a>    
                <h4 className="s3dm_post_list_headline">{title}</h4>
                <div className="tags-container uk-margin-bottom" dangerouslySetInnerHTML={{__html: tags}}>
                </div>
                <div dangerouslySetInnerHTML={{__html:image}}></div>
  
            </div>
          );
        }else{
          return (
            <div></div>
          );
        }
        
      });

      lastPosts = posts.map(({title, image, tags, excerpt, date, link}, index) => {
        
        if(index !== 0){
          return (
            <div className="uk-position-relative" key={index}>
          
                <a href={link} className="uk-position-cover"><span className="uk-hidden">{title}</span></a>    
                <h4 className="s3dm_post_list_headline">{title}</h4>
                <div className="tags-container uk-margin-bottom" dangerouslySetInnerHTML={{__html: tags}}>
                </div>
  
            </div>
          );
        }else{
          return (
            <div></div>
          );
        }
        
      });
    }


    return (
      <div className="topics-news uk-child-width-1-2@m uk-child-width" uk-grid="">
        <div>
          {firstPost}
        </div>
        <div>
          {lastPosts}
        </div>
      </div>
    )
  

  }



  render() {
    const posts = this.props.__postData;
    const layout = this.props.post_list_layout;

    return (
      <div>
        {this.renderLayout(layout, posts)}
      </div>
    );
  }
}

export default S3DM_PostList;
