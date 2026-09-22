import { InspectorControls, RichText, URLInputButton, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';
import type { BlockEditProps } from '@wordpress/blocks';
import metadata from './block.json';
import './editor.scss';

type Attributes = {
  eyebrow: string;
  heading: string;
  text: string;
  buttonText: string;
  buttonUrl: string;
};

const Edit = ({ attributes, setAttributes }: BlockEditProps<Attributes>) => (
    <>
      <InspectorControls>
        <PanelBody title="CTA">
          <TextControl
            label="Button label"
            value={attributes.buttonText}
            onChange={(buttonText) => setAttributes({ buttonText })}
          />
          <URLInputButton
            url={attributes.buttonUrl}
            onChange={(buttonUrl) => setAttributes({ buttonUrl })}
          />
        </PanelBody>
      </InspectorControls>
      <section {...useBlockProps({ className: 'hero-block' })}>
        <RichText
          tagName="p"
          className="hero-block__eyebrow"
          value={attributes.eyebrow}
          onChange={(eyebrow) => setAttributes({ eyebrow })}
        />
        <RichText
          tagName="h1"
          className="hero-block__heading"
          value={attributes.heading}
          onChange={(heading) => setAttributes({ heading })}
        />
        <RichText
          tagName="p"
          className="hero-block__text"
          value={attributes.text}
          onChange={(text) => setAttributes({ text })}
        />
      </section>
    </>
);

registerBlockType<Attributes>(metadata.name, {
  ...metadata,
  edit: Edit,
  save: () => null,
});
