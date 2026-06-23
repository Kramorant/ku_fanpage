import { TestBed } from '@angular/core/testing';
import { BlogListComponent } from './blog-list.component';
import { appTestProviders } from '../../../testing-setup';

describe('BlogListComponent', () => {
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [BlogListComponent],
      providers: [...appTestProviders],
    }).compileComponents();
  });

  it('should create', () => {
    const fixture = TestBed.createComponent(BlogListComponent);
    const component = fixture.componentInstance;
    expect(component).toBeTruthy();
  });
});
