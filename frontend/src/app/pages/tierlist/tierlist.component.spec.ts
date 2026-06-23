import { TestBed } from '@angular/core/testing';
import { TierlistComponent } from './tierlist.component';
import { appTestProviders } from '../../testing-setup';

describe('TierlistComponent', () => {
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [TierlistComponent],
      providers: [...appTestProviders],
    }).compileComponents();
  });

  it('should create', () => {
    const fixture = TestBed.createComponent(TierlistComponent);
    const component = fixture.componentInstance;
    expect(component).toBeTruthy();
  });
});
