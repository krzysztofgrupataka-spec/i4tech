import { RichText, useBlockProps } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';
import type { BlockEditProps } from '@wordpress/blocks';
import metadata from './block.json';
import './editor.scss';

type Card = {
  title: string;
  text: string;
};

type Attributes = {
  heading: string;
  items: Card[];
};

const Edit = ({ attributes, setAttributes }: BlockEditProps<Attributes>) => {
    const updateItem = (index: number, next: Partial<Card>): void => {
      const items = attributes.items.map((item, itemIndex) =>
        itemIndex === index ? { ...item, ...next } : item,
      );
      setAttributes({ items });
    };

    return (
      <section {...useBlockProps({ className: 'cards-block' })}>
        <RichText
          tagName="h2"
          value={attributes.heading}
          onChange={(heading) => setAttributes({ heading })}
        />
        <div className="cards-block__grid">
          {attributes.items.map((item, index) => (
            <article className="cards-block__card" key={index}>
              <RichText
                tagName="h3"
                value={item.title}
                onChange={(title) => updateItem(index, { title })}
              />
              <RichText
                tagName="p"
                value={item.text}
                onChange={(text) => updateItem(index, { text })}
              />
            </article>
          ))}
        </div>
        <Button
          variant="secondary"
          onClick={() =>
            setAttributes({ items: [...attributes.items, { title: 'New card', text: 'Card text.' }] })
          }
        >
          Add card
        </Button>
      </section>
    );
};

registerBlockType<Attributes>(metadata.name, {
  ...metadata,
  edit: Edit,
  save: () => null,
});
