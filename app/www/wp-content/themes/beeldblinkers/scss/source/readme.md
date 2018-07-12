# SASS Folder structure

## Structure inspired by Atomic Design [link](https://blog.groupbuddies.com/posts/32-our-css-sass-project-architecture-and-styleguide)

```
stylesheets/
|- application.sass
|- utilities/
|    |- _variables.sass
|    |- _reset.sass
|    |- _media_queries.sass
|    |- _grid.sass
|    |- ... 
|- atoms/
|    |- _headings.sass
|    |- _buttons.sass
|    |- _inputs.sass
|    |- ... 
|- molecules/
|    |- _media.sass
|    |- _search_form.sass
|    |- ... 
|- organisms/
|    |- _header.sass
|    |- _footer.sass
|    |- _sign_in_form.sass
|    |- _news_feed.sass
|    |- ... 
|- templates/
|    |- _default_layout.sass
|    |- _book_page.sass
|    |- ...
```
There is only one Sass file at the root level: `application.sass`. All the other files are 
divided into specific folders and are Sass partials, i.e. they are prefixed with an underscore (`_`), 
so that they are not compiled into .css files, you can read more about it [here](https://sass-lang.com/guide).  
  
It is the root file's purpose to import and merge all the others. Usually, we tend to have one component per 
file with a name that describes purpose, like the name of the component it stands for. 
This way, we can easily find what we're looking for.  
  
The order in which the folders are imported is as follows:  
  
**Utilities**
We need a set of system-wide styles to begin our design. This folder will need to define the foundation, i.e., 
a set of global classes, mixins, variables and styles that can be used anywhere and anytime.  
  
**Atoms**
Atoms are the basic building blocks of matter. Applied to web interfaces, atoms are our HTML tags, such as a form label, an input or a button.  
Atoms can also include more abstract elements like color palettes, fonts and even more invisible aspects of an interface like animations.  
  
**Molecules**
  
Molecules are groups of atoms combined together and are the smallest fundamental units of a compound, built for reuse. 
These molecules take on their own properties and serve as the backbone of our design system. For example, a search form.  
  
**Organisms**
  
Organisms are groups of molecules joined together to form a relatively complex, distinct section of an interface, 
such as a header or a footer.  
  
**Templates**
  
Templates consist mostly of groups of organisms stitched together to form pages. Templates are very concrete and 
provide context to all these relatively abstract molecules and organisms by applying some layout rules.  
  