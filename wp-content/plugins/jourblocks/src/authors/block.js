const { RichText, MediaUpload, PlainText, InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Button } = wp.components;
const { __ } = wp.i18n;

// Import our CSS files
import "./style.scss";
import "./editor.scss";

registerBlockType("jourblocks/authors", {
  title: "Author",
  icon: "groups",
  category: "common",
  keywords: [
    __("Authors", "jourblocks"),
    __("Students", "jourblocks"),
    __("Writers", "jourblocks"),
    __("Contributors", "jourblocks")
  ],
  description: __(
    "Add a list of author bios at the end of the post.",
    "jourblocks"
  ),
  attributes: {
    body: {
      type: "string"
    }
  },
  edit({ attributes, className, setAttributes }) {
    return (
      <div className="author__container">
        <h2>Authors</h2>
        <InnerBlocks
          allowedBlocks={["jourblocks/author-profile"]}
          template={TEMPLATEA}
        />
      </div>
    );
  },

  save: ({ attributes }) => {
    return (
      <div className="author__container">
        <h2>Authors</h2>
        <InnerBlocks.Content />
      </div>
    );
  }
});

const TEMPLATEA = [["jourblocks/author-profile", {}, []]];
